<?php

namespace App\Filament\Admin\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
class EditProfile extends BaseEditProfile
{
    public static function getLabel(): string
    {
        return 'Edit Profil';
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('username')
                ->label('User')
                ->disabled()
                ->dehydrated(false),

            TextInput::make('nama')
                ->label('Nama')
                ->required()
                ->maxLength(255),

            TextInput::make('password')
                ->label('Password Baru')
                ->password()
                ->revealable(filament()->arePasswordsRevealable())
                ->autocomplete('new-password')
                ->dehydrateStateUsing(fn ($state) => filled($state) ? bcrypt($state) : null)
                ->dehydrated(fn ($state) => filled($state))
                ->maxLength(255),

            TextInput::make('passwordConfirmation')
                ->label('Konfirmasi Password')
                ->password()
                ->same('password')
                ->revealable(filament()->arePasswordsRevealable())
                ->required(fn (Get $get) => filled($get('password')))
                ->dehydrated(false)
                ->visible(fn (Get $get) => filled($get('password'))),
        ]);
    }
}