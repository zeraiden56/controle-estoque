import React from 'react';
import ThemeToggle from './components/ThemeToggle';

function App() {
  return (
    <div className="min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-white">
      <header className="flex justify-between items-center p-4 shadow-md">
        <h1 className="text-xl font-bold">Controle de Estoque</h1>
        <ThemeToggle />
      </header>
      <main className="p-4">
        <h2 className="text-2xl mb-4">Dashboard</h2>
        {/* Aqui serão integradas as páginas: login, produtos, vendas, etc. */}
        <p>Conteúdo do dashboard</p>
      </main>
    </div>
  );
}

export default App;
