// ./assets/js/components/Posts.js
    
import React, {Component} from 'react';
import axios from 'axios';
    
    
class Messages extends Component {
    constructor() {
        super();
        
        this.state = { messages: [], loading: true}
    }
    
    componentDidMount() {
        fetch("http://localhost:8000/api/rooms/1/")
        .then(res => res.json())
        .then(
            (result) => {
                this.setState({
                    isLoaded: true,
                    messages: result.messages
                })
            }
        )
    }
    getPosts() {
        axios.get(`http://localhost:8000/apip/rooms/1/`).then(res => {
            const messages = res.data.slice(0,15);
            this.setState({ messages, loading: false })
        })
    }
    
    render() {
        const loading = this.state.loading;
        const messages = this.state.messages;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Room chat</span> <i
                                className="fa fa-heart"></i>  </h2>
                        </div>
    
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
    
                        ) : (
                            <div className={'row'}>
                                {messages.flat().map(messages =>
                                    <div className="col-md-10 offset-md-1 row-block" key={message.id}>
                                        <ul id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-body">
                                                        <h4>{messages.content}</h4>
                                                        <p>{messages.published}</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
    
export default Messages;