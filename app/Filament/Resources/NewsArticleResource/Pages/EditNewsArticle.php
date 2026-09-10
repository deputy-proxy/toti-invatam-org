<?php
namespace App\Filament\Resources\NewsArticleResource\Pages;
use App\Filament\Resources\NewsArticleResource;
use Filament\Resources\Pages\EditRecord;
class EditNewsArticle extends EditRecord { protected static string $resource = NewsArticleResource::class;
    protected function getHeaderActions(): array { return [\Filament\Actions\DeleteAction::make()]; } }
