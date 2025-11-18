<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KegiatanResource\Pages;
use App\Filament\Admin\Resources\KegiatanResource\RelationManagers;
use App\Models\Kegiatan;
use App\Models\Admin;
use App\Models\KategoriKegiatan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Str;
use Filament\Forms\set;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Filament\Notifications\Notification;
use App\Jobs\SendKegiatanNotificationJob;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\BadgeColumn;
use App\Models\Campaign;

use Carbon\Carbon;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    // protected static ?string $navigationGroup = 'Kegiatan';
    public function getTitle(): string
    {
        return 'Dokumentasi Kegiatan';
    }
        public static function getPluralModelLabel(): string
    {
        return 'Dokumentasi Kegiatan';
    }
       
    protected static ?string $title = 'Upload Kegiatan';
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
                        $campaign = Campaign::with('kategori')->find($state);

                        if ($campaign) {
                            $set('id_kategori', $campaign->kategori?->id_kategori);
                            $set('nama_kategori', $campaign->kategori?->nama_kategori);
                            $set('judul', $campaign->judul_campaign);
                            $set('tanggal_upload', $campaign->tanggal_mulai);

                            // generate slug
                            $baseSlug = Str::slug($campaign->judul_campaign);
                            $slug = $baseSlug;
                            $counter = 1;

                            while (\App\Models\Kegiatan::where('slug', $slug)->exists()) {
                                $slug = $baseSlug . '-' . $counter;
                                $counter++;
                            }

                            $set('slug', $slug);
                        }
                    })
                    ->helperText('Pilih campaign, maka kategori, judul, dan tanggal akan otomatis terisi.'),
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

              Forms\Components\TextInput::make('judul')
                ->readOnly()
                ->helperText('Otomatis dari judul campaign'),
                

            Forms\Components\TextInput::make('slug')
                ->required()
                ->readOnly(true)
                ->helperText('Otomatis terisi dari judul')
                ->maxLength(255),

                Forms\Components\FileUpload::make('dokumentasi_kegiatan')
                    ->label('Upload Thumbnail') 
                    ->image()
                    ->required()
                    ->directory('kegiatan')
                    ->previewable(true)
                    ->maxSize(2048), // 2MB max
                Forms\Components\RichEditor::make('deskripsi_lengkap')
                    ->required()
                    ->fileAttachmentsDirectory('kegiatan/post')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('tanggal_upload')
                    ->label('Tanggal Kegiatan') 
                    ->native(false) // Nonaktifkan date-time picker bawaan browser
                    ->closeOnDateSelection(false)
                    ->seconds(false)
                    ->displayFormat('l, d F Y')
                    ->minDate(today())
                    ->readOnly()
                    ->helperText('Otomatis dari tanggal campaign')
                    ->required(),
                hidden::make('status')
                            ->default('published')
                            ->required(),
                // Forms\Components\Textarea::make('ringkasan_kegiatan')
                //     ->required()
                //     ->columnSpanFull(),
            ]); 
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('admin.nama')
                    ->label('Admin')
                    ->numeric(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori')

                ->label('Jenis Kategori')
                    ->numeric(),
                Tables\Columns\TextColumn::make('campaign.judul_campaign')
                        ->label('campaign terkait'),
                Tables\Columns\TextColumn::make('judul')
                ->label('Judul Kegiatan')
                    ->searchable(),
               Tables\Columns\IconColumn::make('email_notification_sent')
                    ->label('Email Sent')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('secondary'),

                // TextColumn::make('deskripsi_lengkap')
                // ->label('Deskripsi Kegiatan')
                // ->limit(50)
                // ->html()
                // ->extraAttributes(['class' => 'cursor-pointer text-primary underline','title' => 'klik untuk lihat deskripsi lengkap',])
                // ->action(
                //     Action::make('lihatDeskripsi')
                //         ->label('Lihat Deskripsi Lengkap')
                //         ->modalHeading('Deskripsi Lengkap')
                //         ->disabledForm(true)
                //         ->modalContent(fn ($record) => new HtmlString($record->deskripsi_lengkap))
                        
                        
                // ),
                Tables\Columns\TextColumn::make('tanggal_upload')
                    ->label('Tanggal_Upload')
                    ->date()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
            
                Tables\Columns\ImageColumn::make('dokumentasi_kegiatan')
                    ->label('Gambar Thumbnail')
                    ->label('Gambar'),
                // Tables\Columns\TextColumn::make('tanggal_upload')
                    
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_kategori')
                    ->label("Nama Kategori")
                    ->relationship('kategori', 'nama_kategori'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ViewAction::make(),
                
                Tables\Actions\Action::make('view_donateurs')
                    ->label('Lihat Donatur')
                    ->icon('heroicon-o-users')
                    ->color('success')
                    ->modalHeading('Donatur yang Akan Menerima Notifikasi')
                    ->modalContent(fn (Kegiatan $record) => view('filament.modals.donateurs-list', [
                        'donateurs' => $record->getRelatedDonateurs()
                    ]))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
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
            'index' => Pages\ListKegiatans::route('/'),
            'create' => Pages\CreateKegiatan::route('/create'),
            'edit' => Pages\EditKegiatan::route('/{record}/edit'),
        ];
    }
}
