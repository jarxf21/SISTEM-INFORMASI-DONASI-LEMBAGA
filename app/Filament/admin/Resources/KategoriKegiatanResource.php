<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KategoriKegiatanResource\Pages;
use App\Filament\Admin\Resources\KategoriKegiatanResource\RelationManagers;
use App\Models\KategoriKegiatan;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use illuminate\Support\Str;
use Filament\Forms\set;

class KategoriKegiatanResource extends Resource
{
    protected static ?string $model = KategoriKegiatan::class;
    // protected static ?string $navigationGroup = 'Kegiatan';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public function getTitle(): string
    {
        return 'Kategori Kegiatan';
    }
        public static function getPluralModelLabel(): string
    {
        return 'Kategori Kegiatan';
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
                ->required()
                ->columnSpanFull(),
                Forms\Components\TextInput::make('nama_kategori')
                    ->required()
                     ->required()->minLength(1)->maxLength(100)
                    ->live(debounce: 500) // Method 1: Pass a debounce value here
                    ->debounce(500) // or Method 2: Use the debounce method  
                     ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->readOnly(true)
                    ->maxLength(255),
                Forms\Components\Textarea::make('deskripsi_kategori')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('gambar_kategori')
                    ->label('Upload Thumbnail') 
                    ->image()
                    ->required()
                    ->directory('kegiatan')
                    ->previewable(true)
                    ->maxSize(2048), 
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                 // Menampilkan nama admin dari relasi
                Tables\Columns\TextColumn::make('admin.nama')
                    ->label('Nama Admin')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_kategori')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug'),
                Tables\Columns\TextColumn::make('deskripsi_kategori'),
                 Tables\Columns\ImageColumn::make('gambar_kategori')
                    ->label('Gambar Thumbnail')
                    ->label('Gambar'),
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
            'index' => Pages\ListKategoriKegiatans::route('/'),
            'create' => Pages\CreateKategoriKegiatan::route('/create'),
            'edit' => Pages\EditKategoriKegiatan::route('/{record}/edit'),
        ];
    }
}
