import React from 'react';
import '../css/styles.css';
import ReactDOM from 'react-dom';

import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';


import Home from './components/Home';

import Posts from './components/Posts';
import Albums from './components/Albums';

import PostSingle from './components/PostSingle';
import AlbumSingle from './components/AlbumSingle';



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

