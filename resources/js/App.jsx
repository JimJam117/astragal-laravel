import React, {useState} from 'react';
import '../css/styles.css';
import ReactDOM from 'react-dom';

import {BrowserRouter as Router, Switch, Route, Redirect} from 'react-router-dom';


import Home from './components/Home';

import Posts from './components/Posts';
import Albums from './components/Albums';

import not_found from './components/errors/not_found';
import server_error from './components/errors/server_error';
import too_many_requests from './components/errors/too_many_requests';
import page_expired from './components/errors/page_expired';

import PostSingle from './components/PostSingle';
import AlbumSingle from './components/AlbumSingle';

import Search from './components/Search';



function App() {


  return (
    <div className="App">
        <Router basename="/">
        <Switch>
          <Route path="(/|/home)/" exact component={Home}/>

          <Route path="/posts" exact component={Posts}/>
          <Route path="/albums" exact component={Albums}/>

          <Route path="/post/:id" component={PostSingle}/>
          <Route path="/album/:id" component={AlbumSingle}/>

          <Route path="/search/:query" component={Search}/>

          <Route path="/not-found" component={not_found}/>
          <Route path="/server-error" component={server_error}/>
          <Route path="/page-expired" component={page_expired}/>
          <Route path="/too-many-requests" component={too_many_requests}/>

          <Redirect path="/search" to="/"/>

          {/* <Route path="/search/:query" component={SearchResults}/> */}

          
         </Switch>
        </Router>
    </div>
  );
}


export default App;



if (document.getElementById('app')) {
  ReactDOM.render(<App />, document.getElementById('app'));
}

