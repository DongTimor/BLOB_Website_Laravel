<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LikeResource\Pages;
use App\Filament\Resources\LikeResource\RelationManagers;
use App\Models\Like;
use App\Models\LikeModel;
use Filament\Forms;
use Filament\Forms\Form;
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

class LikeResource extends Resource
{
    protected static ?string $model = LikeModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-hand-thumb-up';

    protected static ?string $navigationLabel = 'Like';

    protected static ?string $modelLabel = 'Like Management';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 5;

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
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('content.content')
                    ->searchable(true)
                    ->sortable(),
                Tables\Columns\ImageColumn::make('content.image')->label("Image"),
                Tables\Columns\TextColumn::make('content.user.name')
                    ->label("Creater")
                    ->searchable(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label("Engager")
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort("content_id")
            ->filters([
                SelectFilter::make('Content')
                ->relationship('content','id')
                ->searchable()
                ->preload(),

                SelectFilter::make('Liked User')
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([

                Section::make('Content')
                    ->schema([

                        TextEntry::make("content.content")
                            ->label("Content")
                            ->columnSpan(7),
                            TextEntry::make("content.user.name")
                            ->columnSpan(2)
                            ->label("Creator"),
                    ])->columns(10),

                Section::make("image")->schema([

                    ImageEntry::make("content.image")
                        ->hiddenLabel()
                        ->alignCenter()
                        ->height(510)
                        ->extraAttributes([
                            "style" => "
                                justify-content: center;
                                align-items: center;
                                object-fit: cover;",
                        ]),

                ])->extraAttributes([
                    "style" => "
                        width: 100%;
                        height: auto;
",
                ]),
                Section::make('Liked User')
                ->schema([
                    TextEntry::make("user.name")
                    ->columnSpan(1)
                    ->label(""),
                ])->columns(1),

                Section::make('Date')
                    ->schema([
                        TextEntry::make("created_at"),
                        TextEntry::make("updated_at"),
                    ])->columns(2)
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
            'index' => Pages\ListLikes::route('/'),
            'create' => Pages\CreateLike::route('/create'),
            // 'view' => Pages\ViewLike::route('/{record}'),
            'edit' => Pages\EditLike::route('/{record}/edit'),
        ];
    }
}
