<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DonaturResource\Pages;
use App\Filament\Admin\Resources\DonaturResource\RelationManagers;
use App\Models\Donatur;
use App\Models\Admin;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
// use App\Filament\Admin\Traits\PreventDeleteIfRelated;

class DonaturResource extends Resource
{
    protected static ?string $model = Donatur::class;
    //  use PreventDeleteIfRelated;
    // protected static ?string $navigationGroup = 'Donatur';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getModelLabel(): string
    {
        return 'Donatur';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Donatur';
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
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('no_whatsApp')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
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
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat'),
                 Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_whatsApp')
                    ->searchable(),
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
            'index' => Pages\ListDonaturs::route('/'),
            'create' => Pages\CreateDonatur::route('/create'),
            'edit' => Pages\EditDonatur::route('/{record}/edit'),
        ];
    }
}
