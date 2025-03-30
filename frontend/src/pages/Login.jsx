// src/pages/Login.jsx
import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { API_URL } from '../config';

const Login = () => {
    const navigate = useNavigate();
    const [user, setUser] = useState('');
    const [password, setPassword] = useState('');
    const [errorMsg, setErrorMsg] = useState('');

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrorMsg('');

        try {
            const response = await fetch(`${API_URL}/usuarios/`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ user, password }),
            });

            const contentType = response.headers.get("content-type");
            const isJson = contentType && contentType.includes("application/json");
            const data = isJson ? await response.json() : {};

            if (!response.ok) {
                throw new Error(data?.error || 'Credenciais inválidas.');
            }

            // Armazena token e dados do usuário localmente
            localStorage.setItem('token', data.token);
            localStorage.setItem('usuario', JSON.stringify(data.usuario));

            // Redireciona para dashboard
            navigate('/');
        } catch (error) {
            setErrorMsg(error.message || 'Erro ao realizar login.');
        }
    };

    return (
        <div className="flex items-center justify-center h-screen bg-gray-200">
            <div className="w-full max-w-xl bg-white p-16 rounded shadow">
                <div className="flex flex-col items-center mb-12">
                    <img src="/logo-preta.svg" alt="Logo Goberri" className="w-80 h-80" />
                    <h1 className="mt-6 text-7xl font-bold text-black">Goberri</h1>
                    <p className="text-4xl text-black">cPanel</p>
                </div>

                {errorMsg && (
                    <p className="text-red-500 text-center mb-8">{errorMsg}</p>
                )}

                <form onSubmit={handleSubmit} className="space-y-8">
                    <div>
                        <label htmlFor="user" className="block text-2xl text-black mb-4">
                            Usuário
                        </label>
                        <input
                            type="text"
                            id="user"
                            value={user}
                            onChange={(e) => setUser(e.target.value)}
                            placeholder="Digite seu usuário"
                            required
                            className="w-full p-6 border border-gray-300 rounded focus:outline-none focus:ring-4 focus:ring-black text-2xl"
                        />
                    </div>

                    <div>
                        <label htmlFor="password" className="block text-2xl text-black mb-4">
                            Senha
                        </label>
                        <input
                            type="password"
                            id="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            placeholder="Digite sua senha"
                            required
                            className="w-full p-6 border border-gray-300 rounded focus:outline-none focus:ring-4 focus:ring-black text-2xl"
                        />
                    </div>

                    <button
                        type="submit"
                        className="w-full py-6 border-2 border-black bg-white text-black rounded hover:bg-black hover:text-white transition-colors text-2xl"
                    >
                        Entrar
                    </button>
                </form>
            </div>
        </div>
    );
};

export default Login;
