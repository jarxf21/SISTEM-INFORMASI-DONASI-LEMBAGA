<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonasiResource\Pages;
use App\Filament\Admin\Resources\DonasiResource\RelationManagers;
use App\Models\Donasi;
use Filament\Forms;
use App\Models\Admin;
use App\Models\Donatur;
use App\Models\KategoriKegiatan;
use App\Models\Campaign;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Support\RawJs;
use Carbon\Carbon;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Traits\PreventDeleteIfRelated;

class DonasiResource extends Resource
{
    protected static ?string $model = Donasi::class; 
    // protected static ?string $navigationGroup = 'Donasi';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    use PreventDeleteIfRelated;


    public static function getModelLabel(): string
    {
        return 'Donasi';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Donasi';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_admin')
                ->label('Admin')
                ->options(function () {
                    return \App\Models\Admin::pluck('nama', 'id_admin');
                })
                ->default(function () {
                    $admin = \Illuminate\Support\Facades\Auth::user();
                    return $admin ? $admin->id_admin : null;
                })
                ->disabled(true)
                ->dehydrated(true) // <-- pastikan tetap dikirim ke backend
                ->required(),
                Forms\Components\Select::make('id_donatur')
                    ->label('Nama Donatur')
                    ->options(function () {
                            return donatur::pluck('nama','id_donatur'); // 'name' as display, 'id' as value
                    })
                    ->searchable()
                    ->preload()
                    ->required(),
               

                     Forms\Components\Select::make('id_campaign')
                    ->label('Pilih Campaign')
                    ->searchable()
                    ->options(
                        \App\Models\Campaign::where('tanggal_mulai', '<=', Carbon::today()) // sudah dimulai
                            ->where('tanggal_selesai', '>=', Carbon::today()) // belum selesai
                            ->latest('created_at')
                            ->take(5)
                            ->pluck('judul_campaign', 'id_campaign')
                            ->toArray()
                    )
                    ->getSearchResultsUsing(fn (string $search) => 
                        \App\Models\Campaign::query()
                            ->where('tanggal_selesai', '>=', Carbon::today())
                            ->where('judul_campaign', 'like', "%{$search}%")
                            ->pluck('judul_campaign', 'id_campaign')
                            ->toArray()
                    )
                    ->getOptionLabelUsing(fn ($value) => 
                        \App\Models\Campaign::find($value)?->judul_campaign
                    )
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $campaign = \App\Models\Campaign::with('kategori')->find($state);
                        if ($campaign && $campaign->kategori) {
                            $set('id_kategori', $campaign->kategori->id_kategori);
                            $set('nama_kategori', $campaign->kategori->nama_kategori);
                        } else {
                            $set('id_kategori', null);
                            $set('nama_kategori', '');
                        }
                    }),



                Hidden::make('id_kategori')
                    ->required(),

                TextInput::make('nama_kategori')
                    ->label('Kategori Kegiatan')
                    ->disabled()
                    ->dehydrated(false) // Tidak dikirim ke server saat submit
                    ->afterStateHydrated(function (TextInput $component, $state, $record) {
                        if ($record?->campaign?->kategori) {
                            $component->state($record->campaign->kategori->nama_kategori);
                        }
                    })
                    ->helperText('nama kategori akan muncul ketika memilih campaign'),
              
                TextInput::make('jumlah_donasi')
                ->label('Jumlah Donasi')
                ->required()
                ->prefix('Rp')
                ->minValue(0)
                ->step(1000)
                ->helperText('Masukkan Jumlah donasi total (dalam rupiah).')
                ->mask(RawJs::make(<<<'JS'
                    text => {
                        let number = text.replace(/\D/g, "");
                        return new Intl.NumberFormat("id-ID").format(number);
                    }
                JS))
                ->dehydrateStateUsing(function ($state) {
                    // Menghapus karakter non-numeric sebelum simpan ke DB
                    return (int) preg_replace('/[^\d]/', '', $state);
                }),

                 Forms\Components\DatePicker::make('tanggal_donasi')
                    ->native(false) // Nonaktifkan date-time picker bawaan browser
                    ->closeOnDateSelection(false)
                    ->seconds(false)
                    ->displayFormat('l, d F Y') 
                    ->minDate(today())
                    ->default(today())
                    ->required(),

                TextInput::make('catatan')
                ->label('Catatan'),
                
                FileUpload::make('bukti_transfer')
                ->label('Upload Bukti Transfer')
                ->image()
                ->disk('public')
                ->directory('campaigns')
                ->visibility('public')
                ->maxSize(2048)
                ->previewable(true)
                ->required(),
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('admin.nama') // Assuming relationship exists
                    ->label('Admin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('donatur.nama')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori') // Assuming relationship exists
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('campaign.judul_campaign')
                    ->label('campaign yang di ikuti')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jumlah_donasi')
                    ->numeric()
                    ->sortable()
                    ,
                Tables\Columns\TextColumn::make('catatan')
                    ->searchable(),
                 Tables\Columns\ImageColumn::make('bukti_transfer')
                    ->label('Bukti Transfer'),
                Tables\Columns\TextColumn::make('tanggal_donasi')
                    ->date()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y'))
                    ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonasis::route('/'),
            'create' => Pages\CreateDonasi::route('/create'),
            'edit' => Pages\EditDonasi::route('/{record}/edit'),
        ];
    }
}
