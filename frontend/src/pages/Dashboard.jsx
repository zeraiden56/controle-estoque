import React, { useEffect, useState } from 'react';
import { API_URL } from '../config';
import ChartVendas from '../components/ChartVendas';

const Dashboard = () => {
    const [stats, setStats] = useState(null);

    useEffect(() => {
        fetch(`${API_URL}/dashboard/index.php`)
            .then(res => res.json())
            .then(data => setStats(data))
            .catch(err => console.error('Erro ao buscar dados da dashboard:', err));
    }, []);

    return (
        <div className="p-4">
            <h2 className="text-2xl font-bold mb-4">Dashboard</h2>
            {!stats ? (
                <p>Carregando...</p>
            ) : (
                <>
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div className="bg-white dark:bg-gray-800 shadow rounded p-4">
                            <h3 className="text-lg font-semibold mb-2">Total de Produtos</h3>
                            <p className="text-2xl font-bold">{stats.totalProdutos}</p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 shadow rounded p-4">
                            <h3 className="text-lg font-semibold mb-2">Total de Vendas</h3>
                            <p className="text-2xl font-bold">{stats.totalVendas}</p>
                        </div>
                        <div className="bg-white dark:bg-gray-800 shadow rounded p-4">
                            <h3 className="text-lg font-semibold mb-2">Lucro Mensal</h3>
                            <p className="text-2xl font-bold">{stats.lucroMensal}</p>
                        </div>
                    </div>

                    {/* Exemplo de gráfico */}
                    {stats.vendasPorMes && (
                        <div className="bg-white dark:bg-gray-800 shadow rounded p-4 mt-4">
                            <h3 className="text-lg font-semibold mb-2">Vendas por Mês</h3>
                            <ChartVendas data={stats.vendasPorMes} />
                        </div>
                    )}
                </>
            )}
        </div>
    );
};

export default Dashboard;
