<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use App\Models\User;
use App\Models\Tag;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Columns\BadgeColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    
    protected static ?string $navigationLabel = 'Пости';
    
    protected static ?string $modelLabel = 'Пост';
    
    protected static ?string $pluralModelLabel = 'Пости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->label('Автор')
                    ->options(User::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),
                    
                TextInput::make('title')
                    ->label('Заголовок')
                    ->required()
                    ->maxLength(255),
                    
                TextInput::make('slug')
                    ->label('Slug')
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                    
                Textarea::make('content')
                    ->label('Контент')
                    ->required()
                    ->rows(10),
                    
                Toggle::make('is_publish')
                    ->label('Опубліковано')
                    ->default(false),
                    
                FileUpload::make('image')
                    ->label('Зображення')
                    ->image()
                    ->directory('posts'),
                    
                Select::make('tags')
                    ->label('Теги')
                    ->multiple()
                    ->options(Tag::all()->pluck('name', 'id'))
                    ->searchable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Заголовок')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                    
                TextColumn::make('author.name')
                    ->label('Автор')
                    ->searchable()
                    ->sortable(),
                    
                ToggleColumn::make('is_publish')
                    ->label('Опубліковано'),
                    
                ImageColumn::make('image')
                    ->label('Зображення')
                    ->circular(),
                    
                TextColumn::make('tags.name')
                    ->label('Теги')
                    ->badge()
                    ->separator(','),
                    
                TextColumn::make('created_at')
                    ->label('Створено')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('is_publish')
                    ->label('Статус')
                    ->options([
                        '1' => 'Опубліковано',
                        '0' => 'Чернетка',
                    ]),
                    
                Tables\Filters\SelectFilter::make('user_id')
                    ->label('Автор')
                    ->options(User::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
