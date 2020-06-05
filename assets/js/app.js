import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import Home from './components/Home';

const onclick = document.getElementById('onclick')
onclick.addEventListener('click',function display_vote() {
    var display = document.getElementById('display')
    if (display.style.display = "none") {
        display.style.display = "block"
    }
    else {
        display.style.display = "none"
    }
}) 
function display_vote() {
    var display = document.getElementById('display')
    if (display.style.display = "none") {
        display.style.display = "block"
    }
    else {
        display.style.display = "none"
    }
}

ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));
