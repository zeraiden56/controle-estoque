import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import Layout from './Layout';
import Dashboard from './pages/Dashboard';
import Login from './pages/Login';
import Produtos from './pages/Produtos';
import Vendas from './pages/Vendas';
import Relatorios from './pages/Relatorios';
import Whatsapp from './pages/Whatsapp';
import Configuracoes from './pages/Configuracoes';
import Usuarios from './pages/Usuarios';
import Novidades from './pages/Novidades';
import Perfil from './pages/Perfil';

// Componente para proteger rotas privadas
const PrivateRoute = ({ children }) => {
    const token = localStorage.getItem('token');
    return token ? children : <Navigate to="/login" replace />;
};

function AppRoutes() {
    return (
        <BrowserRouter>
            <Routes>
                {/* Rota pública para login */}
                <Route path="/login" element={<Login />} />

                {/* Rotas protegidas: o Layout e suas rotas filhas só serão acessadas se houver token */}
                <Route
                    path="/"
                    element={
                        <PrivateRoute>
                            <Layout />
                        </PrivateRoute>
                    }
                >
                    <Route index element={<Dashboard />} />
                    <Route path="produtos" element={<Produtos />} />
                    <Route path="vendas" element={<Vendas />} />
                    <Route path="relatorios" element={<Relatorios />} />
                    <Route path="whatsapp" element={<Whatsapp />} />
                    <Route path="configuracoes" element={<Configuracoes />} />
                    <Route path="usuarios" element={<Usuarios />} />
                    <Route path="novidades" element={<Novidades />} />
                    <Route path="perfil" element={<Perfil />} />
                </Route>
            </Routes>
        </BrowserRouter>
    );
}

export default AppRoutes;
