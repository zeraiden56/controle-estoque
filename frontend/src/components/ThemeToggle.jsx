// src/components/ThemeToggle.jsx
import React from 'react';
import { LightBulbIcon as LightBulbOutline } from '@heroicons/react/24/outline';
import { LightBulbIcon as LightBulbSolid } from '@heroicons/react/24/solid';

const ThemeToggle = ({ darkMode, setDarkMode }) => {
    const handleClick = () => {
        console.log("ThemeToggle clicked, darkMode:", darkMode);
        setDarkMode(!darkMode);
    };

    // ThemeToggle.jsx
    return (
        <button
            onClick={() => {
                console.log("Clique no ThemeToggle, darkMode:", darkMode);
                setDarkMode(!darkMode);
            }}
            style={{ background: "green", border: "5px solid red", zIndex: 9999 }}
        >
            Clique
        </button>
    );

};

export default ThemeToggle;
