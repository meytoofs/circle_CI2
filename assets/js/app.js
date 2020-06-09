import '../css/app.css';
import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router } from 'react-router-dom';
import Home from './components/Home';
import noUiSlider from 'nouislider'
import 'nouislider/distribute/nouislider.css'


const slider = document.getElementById('price-slider');

if (slider) {

    const min = document.getElementById('min')
    const max = document.getElementById('max')
    const minValue = Math.floor(parseInt(slider.dataset.min, 10) / 10) * 10
    const maxValue = Math.ceil(parseInt(slider.dataset.max, 10) / 10) * 10
    const range = noUiSlider.create(slider, {
        start: [min.value || minValue, max.value || maxValue],
        connect: true,
        step: 10,
        range: {
            'min': minValue,
            'max': maxValue
        }
    })
    range.on('slide', function (values, handle) {
        if (handle === 0) {
            min.value = Math.round(values[0])
        }
        if (handle === 1) {
            max.value = Math.round(values[1])
        }
        console.log(values, handle)
    })
}
ReactDOM.render(<Router><Home /></Router>, document.getElementById('root'));
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
