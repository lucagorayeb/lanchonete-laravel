<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProdutoResource\Pages;
use App\Models\Produto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

/**
 * Resource de Produtos do MecDonin.
 *
 * CONTROLE DE ACESSO (RBAC):
 *   - Visualizar listagem : Gerente, Admin
 *   - Criar novos produtos: Gerente, Admin
 *   - Editar produtos     : Gerente, Admin
 *   - Deletar produtos    : Admin (somente)
 *   - Caixa               : sem acesso a este resource
 *
 * A autorização usa auth('admin') — nunca auth() ou auth('web') —
 * para garantir que só funcionários autenticados sejam verificados.
 */
class ProdutoResource extends Resource
{
    protected static ?string $model = Produto::class;

    protected static ?string $navigationIcon  = 'heroicon-o-shopping-bag';
    protected static ?string $navigationGroup = 'Cardápio';
    protected static ?string $modelLabel      = 'Produto';
    protected static ?string $pluralModelLabel = 'Produtos';
    protected static ?int    $navigationSort   = 1;

    // =========================================================
    // CONTROLE DE ACESSO POR ROLE (RBAC)
    // Todos os métodos usam auth('admin') explicitamente.
    // =========================================================

    /**
     * Define se o Resource aparece na navegação lateral.
     * Funcionários com role 'Caixa' não verão este menu.
     */
    public static function canViewAny(): bool
    {
        /** @var \App\Models\Admin|null $admin */
        $admin = auth('admin')->user();

        return $admin?->hasAnyRole(['Gerente', 'Admin']) ?? false;
    }

    /**
     * Permite criar novos produtos apenas para Gerentes e Admins.
     */
    public static function canCreate(): bool
    {
        return auth('admin')->user()?->hasAnyRole(['Gerente', 'Admin']) ?? false;
    }

    /**
     * Permite editar registros para Gerentes e Admins.
     *
     * @param \Illuminate\Database\Eloquent\Model $record
     */
    public static function canEdit(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth('admin')->user()?->hasAnyRole(['Gerente', 'Admin']) ?? false;
    }

    /**
     * Apenas 'Admin' pode deletar produtos — ação irreversível.
     *
     * @param \Illuminate\Database\Eloquent\Model $record
     */
    public static function canDelete(\Illuminate\Database\Eloquent\Model $record): bool
    {
        return auth('admin')->user()?->hasRole('Admin') ?? false;
    }

    // =========================================================
    // FORMULÁRIO
    // =========================================================

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informações do Produto')
                    ->schema([
                        Forms\Components\TextInput::make('nome')
                            ->label('Nome do Produto')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Textarea::make('descricao')
                            ->label('Descrição')
                            ->rows(3)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('preco')
                            ->label('Preço (R$)')
                            ->numeric()
                            ->prefix('R$')
                            ->required(),

                        Forms\Components\Toggle::make('disponivel')
                            ->label('Disponível no cardápio')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }

    // =========================================================
    // TABELA DE LISTAGEM
    // =========================================================

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')
                    ->label('Produto')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('preco')
                    ->label('Preço')
                    ->money('BRL')
                    ->sortable(),

                Tables\Columns\IconColumn::make('disponivel')
                    ->label('Disponível')
                    ->boolean(),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Atualizado em')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('disponivel')
                    ->label('Disponibilidade'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                // DeleteAction visível apenas para Admin (canDelete controla isso)
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // =========================================================
    // PÁGINAS DO RESOURCE
    // =========================================================

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListProdutos::route('/'),
            'create' => Pages\CreateProduto::route('/create'),
            'edit'   => Pages\EditProduto::route('/{record}/edit'),
        ];
    }
}
