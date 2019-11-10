import React, {Component} from 'react';
import {Route, Switch,Redirect, Link} from 'react-router-dom';
import Tracks from './Tracks';
import Create from "./Create";

class Home extends Component {

    render() {
        return (
            <div>
                <nav className="navbar navbar-expand-lg navbar-dark bg-dark">
                    <Link className={"navbar-brand"} to={"/"}> Test Project </Link>
                    <div className="collapse navbar-collapse" id="navbarText">
                        <ul className="navbar-nav mr-auto">
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/tracks"}> Tracks </Link>
                            </li>
                            <li className="nav-item">
                                <Link className={"nav-link"} to={"/create"}> Create </Link>
                            </li>
                        </ul>
                    </div>
                </nav>
                <Switch>
                    <Redirect exact from="/" to="/tracks" />
                    <Route path="/tracks" component={Tracks} />
                    <Route path="/create" component={Create} />
                </Switch>
            </div>
        )
    }
}

export default Home;