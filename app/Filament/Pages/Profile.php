<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Profile extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static string $view = 'filament.pages.profile';
    protected static bool $shouldRegisterNavigation = false;
    public ?array $data = [];
 
    public function mount(): void
    {
        $this->form->fill(
            auth()->user()->attributesToArray()
        );
    }

    public function update()
    {
        auth()->user()->update(
            $this->form->getState()
        );
        Notification::make()
        ->title('Profile updated!')
        ->success()
        ->send();
    }
    protected function getFormActions(): array
    {
        return [
            Action::make('Update Profile')
                ->color('primary')
                ->submit('Update'),
        ];
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Form Users')->columns([ 'sm' => 1, 'xl' => 3, '2xl' => 3,])->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('email')->email()->required(),
                    DatePicker::make('email_verified_at')->required(),
                    TextInput::make('phone')->numeric()->required(),
                    TextInput::make('password')->password()->revealable()->confirmed(),
                    TextInput::make('password_confirmation')->password()->revealable(),
                ])
            ])
            ->statePath('data')
            ->model(auth()->user());
    }
}
