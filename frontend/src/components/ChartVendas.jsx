import React from 'react';
import { LineChart, Line, XAxis, YAxis, CartesianGrid, Tooltip, Legend, ResponsiveContainer } from 'recharts';

const ChartVendas = ({ data }) => {
    return (
        <ResponsiveContainer width="100%" height={300}>
            <LineChart data={data}
                margin={{ top: 5, right: 30, left: 20, bottom: 5 }}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="mes" />
                <YAxis />
                <Tooltip />
                <Legend />
                <Line type="monotone" dataKey="vendas" stroke="#8884d8" />
            </LineChart>
        </ResponsiveContainer>
    );
};

export default ChartVendas;
