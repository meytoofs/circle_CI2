import React, {Component} from 'react';
import {Route, Switch,Redirect, Link, withRouter} from 'react-router-dom';
import Users from './Users';
import Messages from './message';



    
class Home extends Component {
    
    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"/"}> Composant react Quentin </Link>
                </nav>
                <Messages
                />
            </div>
        )
    }
}
    
export default Home;