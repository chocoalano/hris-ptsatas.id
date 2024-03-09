<?php

namespace App\Filament\Resources\Config;

use App\Filament\Resources\Config\UserResource\Pages;
use App\Filament\Resources\Config\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists;
use Filament\Infolists\Infolist;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationLabel = 'Users Manage';
    protected static ?string $navigationGroup = 'Master Data';

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\Tabs::make('Tabs')->tabs([
                    Infolists\Components\Tabs\Tab::make('Personal Data')->schema([
                        Infolists\Components\Section::make()->columns(['sm' => 3, 'xl' => 4, '2xl' => 4])->schema([
                            Infolists\Components\TextEntry::make('name')->color('primary'),
                            Infolists\Components\TextEntry::make('email')->color('primary'),
                            Infolists\Components\TextEntry::make('mobile_phone')->color('primary'),
                            Infolists\Components\TextEntry::make('phone')->color('primary'),
                            Infolists\Components\TextEntry::make('placebirth')->color('primary'),
                            Infolists\Components\TextEntry::make('birthdate')->color('primary'),
                            Infolists\Components\TextEntry::make('gender')->color('primary'),
                            Infolists\Components\TextEntry::make('religion')->color('primary'),
                            Infolists\Components\TextEntry::make('identity_address')->color('primary'),
                            Infolists\Components\TextEntry::make('identity_numbers')->color('primary'),
                            Infolists\Components\TextEntry::make('identity_expired')->color('primary'),
                            Infolists\Components\TextEntry::make('postal_code')->color('primary'),
                            Infolists\Components\TextEntry::make('citizen_idaddress')->color('primary')->columnSpan(2),
                            Infolists\Components\TextEntry::make('recidential_address')->color('primary')->columnSpan(2),
                        ])
                    ]),
                    Infolists\Components\Tabs\Tab::make('Employment')->schema([
                        Infolists\Components\Section::make()->columns(['sm' => 3, 'xl' => 4, '2xl' => 4])->relationship('emp')->schema([
                            Infolists\Components\TextEntry::make('company')->color('primary'),
                            Infolists\Components\TextEntry::make('organization')->color('primary'),
                            Infolists\Components\TextEntry::make('job_position')->color('primary'),
                            Infolists\Components\TextEntry::make('job_level')->color('primary'),
                            Infolists\Components\TextEntry::make('employment_status')->color('primary'),
                            Infolists\Components\TextEntry::make('branch')->color('primary'),
                            Infolists\Components\TextEntry::make('join_date')->color('primary'),
                            Infolists\Components\TextEntry::make('sign_date')->color('primary'),
                            Infolists\Components\TextEntry::make('grade')->color('primary'),
                            Infolists\Components\TextEntry::make('class')->color('primary'),
                            Infolists\Components\TextEntry::make('approval_line')->color('primary'),
                            Infolists\Components\TextEntry::make('approval_manager')->color('primary'),
                        ])
                    ]),
                    Infolists\Components\Tabs\Tab::make('Emergency Contact')->schema([
                        Infolists\Components\Section::make()->columns(['sm' => 3, 'xl' => 4, '2xl' => 4])->relationship('emergency_contact')->schema([
                            Infolists\Components\TextEntry::make('name')->color('primary'),
                            Infolists\Components\TextEntry::make('relationship')->color('primary'),
                            Infolists\Components\TextEntry::make('phone')->color('primary'),
                        ])
                    ]),
                    Infolists\Components\Tabs\Tab::make('Family')->schema([
                        Infolists\Components\RepeatableEntry::make('family')->schema([
                            Infolists\Components\TextEntry::make('name')->color('primary'),
                            Infolists\Components\TextEntry::make('relationship')->color('primary'),
                            Infolists\Components\TextEntry::make('activity')->color('primary'),
                            Infolists\Components\TextEntry::make('age')->color('primary'),
                        ])->columns(4)
                    ]),
                    Infolists\Components\Tabs\Tab::make('Education')->schema([
                        Infolists\Components\RepeatableEntry::make('education')->schema([
                            Infolists\Components\TextEntry::make('agency')->color('primary'),
                            Infolists\Components\TextEntry::make('level')->color('primary'),
                            Infolists\Components\TextEntry::make('status')->color('primary'),
                            Infolists\Components\TextEntry::make('start')->color('primary'),
                            Infolists\Components\TextEntry::make('finish')->color('primary'),
                        ])->columns(5)
                    ]),
                ])->columnSpan(2)
            ]);
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(1)
                ->schema([
                    Forms\Components\Wizard::make([
                        Forms\Components\Wizard\Step::make('Person')->schema([
                            Forms\Components\Grid::make(4)->schema([
                                Forms\Components\TextInput::make('name')->suffixIcon('heroicon-m-user-circle')->required(),
                                Forms\Components\Select::make('role_id')->relationship(name: 'role', titleAttribute: 'name')->label('Role User')->options(\App\Models\Config\Role::all()->pluck('name', 'id'))->suffixIcon('heroicon-m-rectangle-group')->searchable()->required(),
                                Forms\Components\TextInput::make('email')->suffixIcon('heroicon-m-envelope')->required()->email(),
                                Forms\Components\TextInput::make('mobile_phone')->suffixIcon('heroicon-m-device-phone-mobile')->numeric()->required(),
                                Forms\Components\TextInput::make('phone')->suffixIcon('heroicon-m-phone')->numeric()->required(),
                                Forms\Components\TextInput::make('placebirth')->suffixIcon('heroicon-m-map-pin')->required(),
                                Forms\Components\DatePicker::make('birthdate')->suffixIcon('heroicon-m-calendar-days')->required(),
                                Forms\Components\Radio::make('gender')->label('Chosed gender?')->options([
                                    'male' => 'Male',
                                    'female' => 'Female'
                                ])->inline()->required(),
                                Forms\Components\Select::make('religion')->options([
                                    'Catholic'=>'Catholic',
                                    'Islam'=>'Islam',
                                    'Christian'=>'Christian',
                                    'Buddha'=>'Buddha',
                                    'Hindu'=>'Hindu',
                                    'Confucius'=>'Confucius',
                                    'Others'=>'Others'
                                ])->required(),
                                Forms\Components\TextInput::make('password')->password()->required(),
                                Forms\Components\Select::make('identity_address')->options([
                                    'KTP'=>'KTP',
                                    'Passport'=>'Passport',
                                ])->required(),
                                Forms\Components\TextInput::make('identity_numbers')->required()->numeric(),
                                Forms\Components\DatePicker::make('identity_expired')->required(),
                                Forms\Components\TextInput::make('postal_code')->numeric()->required(),
                                Forms\Components\Textarea::make('citizen_idaddress')->columnSpan(2)->required(),
                                Forms\Components\Textarea::make('recidential_address')->columnSpan(2)->required()
                            ])
                        ]),
                        Forms\Components\Wizard\Step::make('Employment')->schema([
                            Forms\Components\Grid::make(4)->schema([
                                Forms\Components\Select::make('emp.company')->options(\App\Models\Master\Company::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.organization')->options(\App\Models\Master\Organization::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.job_position')->options(\App\Models\Master\JobPosition::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.job_level')->options([
                                    'Helper'=>'Helper',
                                    'Operator'=>'Operator',
                                    'Staff'=>'Staff',
                                    'Supervisor'=>'Supervisor',
                                    'Senior'=>'Senior',
                                    'Assistant manager'=>'Assistant manager',
                                    'Manager'=>'Manager',
                                    'General Manager'=>'General Manager',
                                    'Direktur'=>'Direktur',
                                ])->required(),
                                Forms\Components\Select::make('emp.employment_status')->options([
                                    'Daily release'=>'Daily release',
                                    'Probation'=>'Probation',
                                    'Contract'=>'Contract',
                                    'Permanent'=>'Permanent',
                                ])->required(),
                                Forms\Components\Select::make('emp.branch')->options(\App\Models\Master\Branch::all()->pluck('name', 'id'))->required(),
                                Forms\Components\DatePicker::make('emp.join_date')->required(),
                                Forms\Components\DatePicker::make('emp.sign_date')->required(),
                                Forms\Components\Select::make('emp.grade')->options(\App\Models\Master\Grade::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.class')->options(\App\Models\Master\ClassEmp::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.approval_line')->options(\App\Models\User::all()->pluck('name', 'id'))->required(),
                                Forms\Components\Select::make('emp.approval_manager')->options(\App\Models\User::all()->pluck('name', 'id'))->required(),
                            ])
                        ]),
                        Forms\Components\Wizard\Step::make('Family')->schema([
                            Forms\Components\Repeater::make('family')->schema([
                                Forms\Components\Grid::make(4)->schema([
                                    Forms\Components\TextInput::make('name')->label('Fullname')->suffixIcon('heroicon-m-user-circle')->required(),
                                    Forms\Components\Select::make('relationship')->options([
                                        'momy' => 'Momy',
                                        'dady' => 'Dady',
                                        'brother' => 'Brother',
                                        'sister' => 'Sister',
                                        'wife' => 'Wife',
                                        'daughter' => 'Daughter',
                                        'boy' => 'Boy',
                                    ])->required(),
                                    Forms\Components\Select::make('activity')->options([
                                        'worker' => 'Worker',
                                        'housewife' => 'Housewife',
                                        'study' => 'Study',
                                    ])->required(),
                                    Forms\Components\TextInput::make('age')->label('Age')->numeric()->required()
                                ])
                            ])->cloneable()
                        ]),
                        Forms\Components\Wizard\Step::make('Emergency Contact')->schema([
                            Forms\Components\Grid::make(3)->schema([
                                Forms\Components\TextInput::make('ec.name')->label('Fullname')->required()->alpha(),
                                Forms\Components\TextInput::make('ec.relationship')->label('Relationship')->required()->alpha(),
                                Forms\Components\TextInput::make('ec.phone')->label('Phone numbers')->numeric()->required()
                            ])
                        ]),
                        Forms\Components\Wizard\Step::make('Education')->schema([
                            Forms\Components\Repeater::make('education')->schema([
                                Forms\Components\Grid::make(5)->schema([
                                    Forms\Components\TextInput::make('agency')->label('Agency name')->required(),
                                    Forms\Components\Select::make('level')->options([
                                        'sd' => 'SD',
                                        'smp' => 'SMP',
                                        'slta' => 'SM(A/K/U)/Sederajat',
                                        's1' => 'S1',
                                        's2' => 'S2',
                                        's3' => 'S3',
                                    ])->required()->alpha(),
                                    Forms\Components\Select::make('status')->options([
                                        'passed' => 'Passed',
                                        'unpassed' => 'Unpassed',
                                    ])->required()->alpha(),
                                    Forms\Components\DatePicker::make('start')->native(false)->required(),
                                    Forms\Components\DatePicker::make('finish')->native(false)->required()
                                ])
                            ])->cloneable()        
                        ]),
                    ])
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('No.')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
                Tables\Columns\TextColumn::make('mobile_phone')->searchable(),
                Tables\Columns\TextColumn::make('phone')->searchable(),
                Tables\Columns\TextColumn::make('placebirth')->searchable(),
                Tables\Columns\TextColumn::make('birthdate')->searchable(),
                Tables\Columns\TextColumn::make('gender')->badge()
                ->color(fn (string $state): string => match ($state) {
                    'male' => 'primary',
                    'female' => 'success',
                })->searchable(),
                Tables\Columns\TextColumn::make('religion')->searchable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
                Tables\Filters\SelectFilter::make('role')
                    ->relationship('role', 'name')
                    ->options(\App\Models\Config\Role::all()->pluck('name', 'id'))
                    ->searchable()
                    ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            RelationManagers\RoleRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
