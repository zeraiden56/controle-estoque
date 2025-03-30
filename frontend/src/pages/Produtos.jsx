import React, { useEffect, useState } from 'react';
import { API_URL } from '../config';

const Produtos = () => {
    const [produtos, setProdutos] = useState([]);
    const [nome, setNome] = useState('');
    const [descricao, setDescricao] = useState('');
    const [preco, setPreco] = useState(0);
    const [quantidade, setQuantidade] = useState(0);

    // Buscar a lista de produtos ao montar o componente
    useEffect(() => {
        fetch(`${API_URL}/produtos/`)  // Incluindo a barra no final
            .then(res => res.json())
            .then(data => setProdutos(data))
            .catch(err => console.error('Erro ao buscar produtos:', err));
    }, []);

    const criarProduto = (e) => {
        e.preventDefault();
        const novoProduto = {
            nome,
            descricao,
            preco: parseFloat(preco),
            quantidade: parseInt(quantidade)
        };

        fetch(`${API_URL}/produtos/`, {  // Incluindo a barra no final
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(novoProduto)
        })
            .then(res => res.json())
            .then(data => {
                console.log('Produto criado, ID:', data.id);
                setProdutos([...produtos, { id: data.id, ...novoProduto }]);
                setNome('');
                setDescricao('');
                setPreco(0);
                setQuantidade(0);
            })
            .catch(err => console.error('Erro ao criar produto:', err));
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Produtos</h2>
            <form onSubmit={criarProduto} className="mb-4">
                <div className="mb-2">
                    <label className="block">Nome:</label>
                    <input
                        type="text"
                        value={nome}
                        onChange={e => setNome(e.target.value)}
                        className="border p-1 w-full"
                        required
                    />
                </div>
                <div className="mb-2">
                    <label className="block">Descrição:</label>
                    <input
                        type="text"
                        value={descricao}
                        onChange={e => setDescricao(e.target.value)}
                        className="border p-1 w-full"
                    />
                </div>
                <div className="mb-2">
                    <label className="block">Preço:</label>
                    <input
                        type="number"
                        step="0.01"
                        value={preco}
                        onChange={e => setPreco(e.target.value)}
                        className="border p-1 w-full"
                        required
                    />
                </div>
                <div className="mb-2">
                    <label className="block">Quantidade:</label>
                    <input
                        type="number"
                        value={quantidade}
                        onChange={e => setQuantidade(e.target.value)}
                        className="border p-1 w-full"
                        required
                    />
                </div>
                <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">
                    Criar Produto
                </button>
            </form>

            <table className="min-w-full border">
                <thead>
                    <tr className="bg-gray-200">
                        <th className="p-2 border">ID</th>
                        <th className="p-2 border">Nome</th>
                        <th className="p-2 border">Descrição</th>
                        <th className="p-2 border">Preço</th>
                        <th className="p-2 border">Quantidade</th>
                    </tr>
                </thead>
                <tbody>
                    {produtos.map((prod) => (
                        <tr key={prod.id}>
                            <td className="p-2 border">{prod.id}</td>
                            <td className="p-2 border">{prod.nome}</td>
                            <td className="p-2 border">{prod.descricao}</td>
                            <td className="p-2 border">{prod.preco}</td>
                            <td className="p-2 border">{prod.quantidade}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    );
};

export default Produtos;
