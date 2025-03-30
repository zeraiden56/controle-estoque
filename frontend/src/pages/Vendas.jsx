import React, { useEffect, useState } from 'react';
import { API_URL } from '../config';

const Vendas = () => {
    const [vendas, setVendas] = useState([]);
    const [usuarioId, setUsuarioId] = useState(1); // Exemplo fixo
    const [novaVenda, setNovaVenda] = useState({ usuario_id: 1, itens: [] });

    useEffect(() => {
        fetch(`${API_URL}/vendas/`) // Incluindo a barra no final
            .then(res => res.json())
            .then(data => setVendas(data))
            .catch(err => console.error('Erro ao buscar vendas:', err));
    }, []);

    const criarVenda = () => {
        fetch(`${API_URL}/vendas/`, { // Incluindo a barra no final
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(novaVenda)
        })
            .then(res => res.json())
            .then(data => {
                console.log('Venda criada, ID:', data.venda_id);
                setVendas([...vendas, { id: data.venda_id, ...novaVenda }]);
                setNovaVenda({ usuario_id: usuarioId, itens: [] });
            })
            .catch(err => console.error('Erro ao criar venda:', err));
    };

    return (
        <div className="p-4">
            <h2 className="text-2xl mb-4">Vendas</h2>
            <button
                onClick={criarVenda}
                className="bg-blue-500 text-white px-4 py-2 rounded"
            >
                Criar Venda Vazia
            </button>

            <ul className="mt-4">
                {vendas.map((v) => (
                    <li key={v.id} className="mb-2 border p-2">
                        <strong>Venda ID:</strong> {v.id} <br />
                        <strong>Usuário ID:</strong> {v.usuario_id} <br />
                        {v.itens && v.itens.length > 0 ? (
                            <ul className="mt-2">
                                {v.itens.map((item, idx) => (
                                    <li key={idx}>
                                        Produto ID: {item.produto_id}, Qtd: {item.quantidade}, Valor:
                                        {item.valor_unitario}
                                    </li>
                                ))}
                            </ul>
                        ) : (
                            <span className="text-gray-600">Sem itens</span>
                        )}
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Vendas;
