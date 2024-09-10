<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContentResource\Pages;
use App\Filament\Resources\ContentResource\RelationManagers;
use App\Models\ContentModel;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\Section;
use Filament\Forms\Form;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Infolists\Components\Session;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Infolists\Components\Split;
use Filament\Notifications\Notification;
use Filament\Support\Enums\FontWeight;

class ContentResource extends Resource
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
            'index' => Pages\ListContents::route('/'),
            // 'create' => Pages\CreateContent::route('/create'),
            'view' => Pages\ViewContent::route('/{record}'),
            // 'delete' => Pages\EditContent::route('/{record}/edit'),

        ];
    }
}
