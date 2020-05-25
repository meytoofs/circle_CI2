import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import Home from './components/Home';
console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));
