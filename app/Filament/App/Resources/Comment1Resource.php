<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\Comment1Resource\Pages;
use App\Filament\App\Resources\Comment1Resource\RelationManagers;
use app\Filament\App\Resources\Comment1;
use App\Models\CommentModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class Comment1Resource extends Resource
{
    protected static ?string $model = CommentModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Comment';

    protected static ?string $modelLabel = 'Comments';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 4;

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
                Tables\Columns\TextColumn::make('content.user.name')
                    ->label('Creator')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('content.content')
                    ->label('Content')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\ImageColumn::make('content.image')
                ->label("image")
                ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('comment')
                    ->label('Comment')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->date("d/m/Y")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->date("d/m/Y")
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(true)
                    ->sortable(),
            ])->defaultSort('content_id')
            ->filters([
                SelectFilter::make('User')
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
                            ->weight(FontWeight::Bold)
                            ->color("primary")
                            ->label("Creator"),
                    ])->columns(10),


                    Section::make('Comment')
                    ->schema([

                        TextEntry::make("comment")
                            ->label("Conmment")
                            ->columnSpan(7),
                            TextEntry::make("user.name")
                            ->columnSpan(2)
                            ->weight(FontWeight::Bold)
                            ->color("primary")
                            ->label("Comment User"),
                    ])->columns(10),
                Section::make('Date')
                    ->schema([
                        TextEntry::make("created_at")
                        ->columnSpan(7),
                        TextEntry::make("updated_at")
                        ->columnSpan(2),
                    ])->columns(10)
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
            'index' => Pages\ListComment1s::route('/'),
            'create' => Pages\CreateComment1::route('/create'),
            'edit' => Pages\EditComment1::route('/{record}/edit'),
        ];
    }
}
