<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\CampaignResource\Pages;
use App\Models\Admin;
use App\Models\Campaign;
use App\Models\KategoriKegiatan;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\Html;
use Filament\Support\RawJs;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\HtmlString;


class CampaignResource extends Resource
{
    protected static ?string $model = Campaign::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getModelLabel(): string
    {
        return 'Campaign';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Campaign';
    }

    public static function form(Form $form): Form
    
{
    return $form
        ->schema([
            Select::make('id_admin')
                ->label('Admin')
                ->options(function () {
                    return \App\Models\Admin::pluck('nama', 'id_admin');
                })
                ->default(function () {
                    $admin = \Illuminate\Support\Facades\Auth::user();
                    return $admin ? $admin->id_admin : null;
                })
                ->disabled(true)
                ->dehydrated(true)
                ->required(),

            Select::make('id_kategori')
                ->label('Kategori kegiatan')
                ->options(function () {
                    return \App\Models\KategoriKegiatan::pluck('nama_kategori','id_kategori');
                })
                ->searchable()
                
                ->required(),

           TextInput::make('judul_campaign')
    ->label('Judul Campaign')
    ->required()
    ->lazy() // hanya trigger ketika user selesai mengetik / keluar dari field
    ->afterStateUpdated(function ($state, callable $set) {
        if (!empty($state)) {
            $baseSlug = \Illuminate\Support\Str::slug($state);
            $slug = $baseSlug;
            $counter = 1;

            // Cek duplikasi di database
            while (\App\Models\Campaign::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Set slug otomatis
            $set('slug', $slug);
        }
    })
    ->helperText('Isi judul, slug akan otomatis terbentuk ketika selesai mengetik.'),

TextInput::make('slug')
    ->label('Slug')
    ->required()
    ->readOnly(true) // Biar user tidak bisa ubah manual
    ->maxLength(255)
    ->helperText('Slug terbentuk otomatis dari judul campaign'),


            Textarea::make('deskripsi')
                ->required()
                ->columnSpanFull(),

           DateTimePicker::make('tanggal_mulai')
                ->label('Tanggal Mulai')
                ->required()
                ->minDate(today())
                ->displayFormat('l, d F Y, H:i') 
                ->format('Y-m-d H:i:s') // format simpan ke DB

                ->timezone('Asia/Jakarta')
                ->native(false) // Nonaktifkan date-time picker bawaan browser
                ->closeOnDateSelection(false)
                ->seconds(false)
                ->extraAlpineAttributes([
                    'x-init' => <<<JS
                        setTimeout(() => {
                            flatpickr(\$el, {
                                enableTime: true,
                                time_24hr: true,
                                dateFormat: "d-m-Y H:i",
                                locale: "id",
                            });
                        }, 100);
                    JS,
                ]),

            DateTimePicker::make('tanggal_selesai')
            ->required()
            ->displayFormat('l, d F Y, H:i') 
            ->timezone('Asia/Jakarta')
            ->format('Y-m-d H:i:s') // format simpan ke DB

            ->minDate(today())
            ->native(false) // Nonaktifkan date-time picker bawaan browser
                ->closeOnDateSelection(false)
                ->seconds(false)
                ->extraAlpineAttributes([
                    'x-init' => <<<JS
                        setTimeout(() => {
                            flatpickr(\$el, {
                                enableTime: true,
                                time_24hr: true,
                                dateFormat: "d-m-Y H:i",
                                locale: "id",
                            });
                        }, 100);
                    JS,
                ]),
             DateTimePicker::make('tanggal_kegiatan')
            ->required()
            ->displayFormat('l, d F Y, H:i') 
            ->timezone('Asia/Jakarta')
            ->format('Y-m-d H:i:s') // format simpan ke DB
            ->helperText('Masukan Tanggal Kegiatan kegiatan ini akan berlangsung')
            ->minDate(today())
            ->native(false) // Nonaktifkan date-time picker bawaan browser
                ->closeOnDateSelection(false)
                ->seconds(false)
                ->extraAlpineAttributes([
                    'x-init' => <<<JS
                        setTimeout(() => {
                            flatpickr(\$el, {
                                enableTime: true,
                                time_24hr: true,
                                dateFormat: "d-m-Y H:i",
                                locale: "id",
                            });
                        }, 100);
                    JS,
                ]),

           TextInput::make('target_donasi')
            ->label('Target Donasi')
            ->columnSpanFull()
            ->minValue(0)
            ->step(1000)
            ->helperText('Masukkan target donasi total (dalam rupiah).')
            ->required()
                ->prefix('Rp')
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
            
            FileUpload::make('gambar_campaign')
                ->label('Gambar Campaign')
                ->image()
                ->disk('public')
                ->directory('campaigns')
                ->visibility('public')
                ->maxSize(2048)
                ->previewable(true)
                ->required(), 
               
            ]);
        // ->saving(function (array $data, \Filament\Forms\Set $set) {
        //     if (\Carbon\Carbon::parse($data['tanggal_selesai'])->isPast()) {
        //         $set('status_campaign', 'selesai');
        //     }
        //     });
              
}

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Display admin name instead of ID
                Tables\Columns\TextColumn::make('admin.nama') // Assuming relationship exists
                    ->label('Admin')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kategori.nama_kategori') // Assuming relationship exists
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('judul_campaign')
                    ->searchable(),
                Tables\Columns\TextColumn::make('target_donasi')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status_campaign')
                ->label('Status Campaign')
                    ->badge()
                ->formatStateUsing(function ($state, $record) {
                    return $state;
                })
                
                 ->color(fn ($state) => match($state) {
                    'belum berlangsung' => 'secondary',
                    'sedang berlangsung' => 'danger',
                    'terlaksana' => 'success',
                    'Target Donasi Tercapai' => 'success',
                    default => 'primary',
                }),

                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->date()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->date()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y'))
                    ->sortable(),

                Tables\Columns\ImageColumn::make('gambar_campaign')
                    ->label('Gambar'),
                    
                Tables\Columns\TextColumn::make('tanggal_kegiatan')
                    ->date()
                    ->formatStateUsing(fn ($state) => \Carbon\Carbon::parse($state)->translatedFormat('l, d F Y'))
                    ->sortable(),

                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable(),
                    
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable(),
                
                    
            ])
                
                ->filters([
            SelectFilter::make('status_campaign')
                ->label('Status')
                ->options([
                    'belum berlangsung' => 'Belum Berlangsung',
                    'sedang berlangsung' => 'Sedang Berlangsung',
                    'terlaksana'        => 'Terlaksana',
                ])
                ->query(function (Builder $query, $data) {
                    if (! $data['value']) {
                        return;
                    }

                    $today = now()->startOfDay();

                    if ($data['value'] === 'belum berlangsung') {
                        $query->whereDate('tanggal_mulai', '>', $today);
                    } elseif ($data['value'] === 'sedang berlangsung') {
                        $query->whereDate('tanggal_mulai', '<=', $today)
                              ->whereDate('tanggal_selesai', '>=', $today);
                    } elseif ($data['value'] === 'terlaksana') {
                        $query->whereDate('tanggal_selesai', '<', $today);
                    }
                }),
            SelectFilter::make('id_kategori')
            ->label('Pilih Kategori')
            ->relationship('kategori', 'nama_kategori')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
// public static function filters(): array
// {
//     return [
//        SelectFilter::make('filter_status')
//     ->label('Status Campaign')
//     ->options([
//         'belum_berlangsung'   => 'Belum Berlangsung',
//         'sedang_berlangsung'  => 'Sedang Berlangsung',
//         'terlaksana'          => 'Terlaksana',
//     ])
//     ->apply(function (Builder $query, string $value) {
//         $today = Carbon::today();

//         if ($value === 'belum_berlangsung') {
//             $query->whereDate('tanggal_mulai', '>', $today);
//         } elseif ($value === 'sedang_berlangsung') {
//             $query->whereDate('tanggal_mulai', '<=', $today)
//                   ->whereDate('tanggal_selesai', '>=', $today);
//         } elseif ($value === 'terlaksana') {
//             $query->whereDate('tanggal_selesai', '<', $today);
//         }

//         return $query;
//     }),


//         SelectFilter::make('id_kategori')
//             ->relationship('kategori', 'nama_kategori'),
//     ];
// }




    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCampaigns::route('/'),
            'create' => Pages\CreateCampaign::route('/create'),
            'edit' => Pages\EditCampaign::route('/{record}/edit'),
        ];
    }
}