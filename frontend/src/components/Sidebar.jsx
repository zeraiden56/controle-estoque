import React from 'react';
import { Link } from 'react-router-dom';

const Sidebar = () => {
    return (
        <aside className="w-64 bg-gray-100 dark:bg-gray-800 h-full p-4">
            <nav>
                <ul>
                    <li className="mb-2">
                        <Link to="/" className="hover:underline">Dashboard</Link>
                    </li>
                    <li className="mb-2">
                        <Link to="/produtos" className="hover:underline">Produtos</Link>
                    </li>
                    <li className="mb-2">
                        <Link to="/vendas" className="hover:underline">Vendas</Link>
                    </li>
                    <li className="mb-2">
                        <Link to="/relatorios" className="hover:underline">Relatórios</Link>
                    </li>
                </ul>
            </nav>
        </aside>
    );
};

export default Sidebar;
