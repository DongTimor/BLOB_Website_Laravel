<?php

namespace App\Filament\App\Resources;

use App\Filament\App\Resources\Content1Resource\Pages;
use App\Filament\App\Resources\Content1Resource\RelationManagers;
use App\Models\ContentModel;
use Capp\Filament\App\Resources\Content1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\ImageEntry;
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

class Content1Resource extends Resource
{
    protected static ?string $model = ContentModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Content';

    protected static ?string $modelLabel = 'Contents';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 3;

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
                Tables\Columns\TextColumn::make('content')
                    ->label('Content')
                    ->searchable(isIndividual: true)
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->sortable(),
                Tables\Columns\TextColumn::make('liked_count')
                    ->counts("liked")
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Like')
                    ->sortable(),
                Tables\Columns\TextColumn::make('comments_count')
                    ->counts("comments")
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label('Comment Count')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->date("d/m/Y")
                    ->searchable(true)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->date("d/m/Y")
                    ->searchable(true)
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->sortable(),
            ])->defaultSort('id')
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

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        $infolist->getRecord()->loadCount('liked');
        $infolist->getRecord()->loadCount('comments');

        return $infolist
            ->schema([

                Section::make('content')
                    ->schema([

                        TextEntry::make("content")
                            ->label("Content")
                            ->columnSpan(7),
                            TextEntry::make("user.name")
                            ->columnSpan(2)
                            ->color("primary")
                            ->weight(FontWeight::Bold)
                            ->label("Creator"),
                    ])->columns(10),

                Section::make("image")->schema([

                    ImageEntry::make("image")
                        ->hiddenLabel()
                        ->alignCenter()
                        ->height(510)
                        ->extraAttributes([
                            "style" => "
                                justify-content: center;
                                align-items: center;
                                object-fit: cover;",
                        ])
                ])->extraAttributes([
                    "style" => "
                        width: 100%;
                        height: auto;
",
                ]),


                    Section::make([
                        Section::make('Interact')
                        ->schema([
                            TextEntry::make("liked_count")->color("danger"),
                            TextEntry::make("comments_count")->color("danger"),
                        ])->columnSpan(1),
                    Section::make('Date')
                        ->schema([
                            TextEntry::make("created_at"),
                            TextEntry::make("updated_at"),
                        ])->columnSpan(1),
                    ])->columns(2)
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContent1s::route('/'),
            'create' => Pages\CreateContent1::route('/create'),
            'edit' => Pages\EditContent1::route('/{record}/edit'),

        ];
    }
}
