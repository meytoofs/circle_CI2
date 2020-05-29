// ./assets/js/components/Posts.js
    
import React, {Component} from 'react';
import axios from 'axios';
import { useLocation } from 'react-router-dom'
    
    
class Messages extends Component {
    constructor() {
        super();
        
        this.state = { messages: [], loading: true}
    }
    
    componentDidMount() {
        var data = document.getElementById('root').dataset.room_id;
        fetch("http://localhost:8000/api/rooms/"+data)
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    isLoaded: false,
                    messages: result.messages
                })
            }
        )
    }
    getPosts() {
        axios.get(`http://localhost:8000/api/rooms/1/`).then(res => {
            const messages = res.data.slice(0,15);
            this.setState({ messages, loading: false })
        })
    }
    HeaderView() {
        let location = useLocation();
        console.log(location.pathname);
        return <span>Path : {location.pathname}</span>
    }
    render() {
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>JOYEUX ANNIVERSAIRE ALEXIA SOEUR CHERIE ! </span></h2>
                        </div>
    

                            <div className={'moi'} data="">
                                {this.state.messages.map(message =>
                                    <div className="col-md-10 offset-md-1 row-block" key={message.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{message.content}</h4>
                                                        <p>{message.published}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                    </div>
                </section>
            </div>
        )
    }
}
    
export default Messages;