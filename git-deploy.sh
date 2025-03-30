#!/bin/bash

# Mensagem padrão de commit, ou personalizada via argumento
MENSAGEM=${1:-"🚀 Atualização do projeto"}

echo "🔄 Adicionando alterações..."
git add .

echo "📦 Commitando alterações..."
git commit -m "$MENSAGEM"

echo "📤 Enviando para o GitHub..."
git push origin main

echo "✅ Deploy finalizado com sucesso!"
