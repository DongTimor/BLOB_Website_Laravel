<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FollowResource\Pages;
use App\Filament\Resources\FollowResource\RelationManagers;
use App\Models\Follow;
use App\Models\FollowModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FollowResource extends Resource
{
    protected static ?string $model = FollowModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationLabel = 'Follow';

    protected static ?string $modelLabel = 'Follows';

    protected static ?string $navigationGroup = 'Follows Management';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): string|array|null
    {
        return static::getModel()::count()>10?'warning':'info';
    }


    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('followable.name')
                    ->label('User')
                    ->searchable(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Folower")
                    ->searchable(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])->defaultSort("user_id")
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filters([
                SelectFilter::make('User')
                ->relationship('followable','name')
                ->searchable()
                ->preload(),

                SelectFilter::make('Follower')
                ->relationship('user','name')
                ->searchable()
                ->preload()
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make()
                ->successNotification(
                    Notification::make()
                    ->success()
                    ->title('User Deleted Success')
                    ->body('The user deleted successfully !')
                ),

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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Section::make('Follow')
                    ->schema([

                        TextEntry::make("followable.name")
                            ->label("User")
                            ->columnSpan(7),
                            TextEntry::make("user.name")
                            ->columnSpan(2)
                            ->label("Follower"),
                    ])->columns(10),
                    ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFollows::route('/'),
            'create' => Pages\CreateFollow::route('/create'),
            // 'view' => Pages\ViewFollow::route('/{record}'),
            'edit' => Pages\EditFollow::route('/{record}/edit'),
        ];
    }
}
