// src/Layout.jsx
import React, { useState, useEffect } from 'react';
import { Outlet, Link, useNavigate } from 'react-router-dom';

import {
    HomeIcon,
    CubeIcon,
    ShoppingCartIcon,
    ChartBarIcon,
    ArrowLeftOnRectangleIcon,
    UserIcon,
    ChatBubbleOvalLeftIcon,
    Cog6ToothIcon,
    BellIcon,
    UserCircleIcon
} from '@heroicons/react/24/outline';

const Sidebar = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        localStorage.removeItem('token');
        localStorage.removeItem('usuario');
        navigate('/login');
    };

    return (
        <aside className="fixed top-48 left-0 w-70 h-[calc(100vh-12rem)] bg-white shadow-[4px_0_4px_-4px_rgba(0,0,0,0.2)] flex flex-col z-10">
            {/* Área de navegação */}
            <nav className="flex-1 p-4">
                <ul className="space-y-2 m-0">
                    <li>
                        <Link to="/" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <HomeIcon className="h-10 w-10 mr-3" />
                            Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link to="/produtos" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <CubeIcon className="h-10 w-10 mr-3" />
                            Produtos
                        </Link>
                    </li>
                    <li>
                        <Link to="/vendas" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <ShoppingCartIcon className="h-10 w-10 mr-3" />
                            Vendas
                        </Link>
                    </li>
                    <li>
                        <Link to="/relatorios" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <ChartBarIcon className="h-10 w-10 mr-3" />
                            Relatórios
                        </Link>
                    </li>
                    <li>
                        <Link to="/usuarios" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <UserIcon className="h-10 w-10 mr-3" />
                            Usuários
                        </Link>
                    </li>
                    <li>
                        <Link to="/whatsapp" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <ChatBubbleOvalLeftIcon className="h-10 w-10 mr-3" />
                            Whatsapp
                        </Link>
                    </li>
                    <li>
                        <Link to="/configuracoes" className="flex items-center p-5 rounded hover:bg-black hover:text-white text-2xl">
                            <Cog6ToothIcon className="h-10 w-10 mr-3" />
                            Configurações
                        </Link>
                    </li>
                </ul>
            </nav>

            {/* Área do botão de logout */}
            <div className="p-4">
                <button
                    className="w-full flex items-center justify-center p-5 bg-red-500 text-white rounded hover:bg-red-600 text-2xl"
                    onClick={handleLogout}
                >
                    <ArrowLeftOnRectangleIcon className="h-10 w-10 mr-3" />
                    Sair
                </button>
            </div>
        </aside>
    );
};


const Header = () => {
    const navigate = useNavigate();

    return (
        <header className="fixed top-0 left-0 w-full h-48 flex items-center justify-between px-4 z-10 shadow-[0_4px_4px_-4px_rgba(0,0,0,0.2)] bg-white dark:bg-gray-800 relative">
            <div className="flex items-center ml-6">
                <img src="/logo-preta.svg" alt="Logo Goberri" className="w-48 h-48 mr-8" />
                <span className="text-7xl text-black font-extrabold">Goberri cPanel</span>
            </div>
            <div className="flex items-center space-x-4 mr-6">
                <button
                    onClick={() => navigate('/novidades')}
                    className="group p-2 rounded hover:bg-black focus:outline-none"
                    title="Notificações"
                >
                    <BellIcon className="h-12 w-12 text-black group-hover:text-white" />
                </button>
                <button
                    onClick={() => navigate('/perfil')}
                    className="group p-2 rounded hover:bg-black focus:outline-none"
                    title="Editar Perfil"
                >
                    <UserCircleIcon className="h-12 w-12 text-black group-hover:text-white" />
                </button>
            </div>
        </header>
    );
};


const Layout = () => {
    return (
        <div className="relative h-screen w-screen overflow-hidden bg-white text-black">
            <Header />
            <Sidebar />

            {/* Área principal rolável com fundo cinza claro e padding */}
            <main
                className="
            ml-64 pt-48 
            h-[calc(100vh-12rem)]
            overflow-auto
            relative
            z-0
            bg-gray-100    /* fundo cinza clarinho */
            p-20           /* padding ao redor do conteúdo */
          "
            >
                <Outlet />
            </main>
        </div>
    );
};


export default Layout;
