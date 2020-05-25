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
                <Switch>
                    <Redirect exact from="/" to="/users" />
                    <Route path="/users" component={Users} />
                    <Route path="/" component={Messages} />
                </Switch>
            </div>
        )
    }
}
    
export default Home;