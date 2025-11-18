<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonasiBarangResource\Pages;
use App\Models\DonasiBarang;
use App\Models\Admin;
use App\Models\Donatur;
use App\Models\Campaign;
use App\Models\KategoriBarang;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use illuminate\Support\Str;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Carbon\Carbon;

class DonasiBarangResource extends Resource
{
    protected static ?string $model = DonasiBarang::class;

    protected static ?string $navigationIcon = 'heroicon-o-gift';
    protected static ?string $navigationGroup = 'Donasi Barang';
    protected static ?string $navigationLabel = 'Donasi Barang';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form->schema([
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

            Forms\Components\Select::make('id_kategori_barang')
                ->label('Kategori Barang')
                ->relationship('kategoriBarang', 'nama_kategori_barang')
                ->required(),

            Forms\Components\TextInput::make('nama_barang')
                ->label('Nama Barang')
                ->required(),

            Forms\Components\TextInput::make('jumlah')
                ->label('Jumlah')
                ->numeric()
                ->default(1),

            Forms\Components\TextInput::make('satuan')
                ->label('Satuan')
                ->placeholder('pcs, liter, box, dll'),

            Forms\Components\Textarea::make('catatan')
                ->label('Keterangan')
                ->rows(3),

            Forms\Components\DatePicker::make('tanggal_donasi')
                ->label('Tanggal Donasi')
                ->native(false) // Nonaktifkan date-time picker bawaan browser
                    ->closeOnDateSelection(false)
                    ->seconds(false)
                    ->displayFormat('l, d F Y')
                    ->minDate(today())
        ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('id_donasi_barang')->label('ID')->sortable(),
            Tables\Columns\TextColumn::make('donatur.nama_donatur')->label('Donatur')->searchable(),
            Tables\Columns\TextColumn::make('campaign.judul_campaign')->label('Campaign')->searchable(),
            Tables\Columns\TextColumn::make('kategoriBarang.nama_kategori_barang')->label('Kategori'),
            Tables\Columns\TextColumn::make('nama_barang')->label('Barang'),
            Tables\Columns\TextColumn::make('jumlah')->label('Jumlah'),
            Tables\Columns\TextColumn::make('satuan')->label('Satuan'),
            Tables\Columns\TextColumn::make('tanggal_donasi')->date()->label('Tanggal Donasi'),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDonasiBarangs::route('/'),
            'create' => Pages\CreateDonasiBarang::route('/create'),
            'edit' => Pages\EditDonasiBarang::route('/{record}/edit'),
        ];
    }
}
