import React, {useState, useRef, useEffect} from 'react';
import {Link, Redirect} from 'react-router-dom';

const Header = () => {

    const [burgerMenu, setburgerMenu] = useState(false);
    const [search, setSearch] = useState("");

    const handleSearchForm = (e) => {
      setSearch(e.target.value);
    }

    const searchSubmit = (e) => {
      e.preventDefault();
      window.location = `/search/${search}`;
    }

    const toggleBurgerMenu = () => setburgerMenu(!burgerMenu);

    return (

            <div id="sMenu" className={burgerMenu ? "top_band": "top_band top_band_closed"}>
            <div className="band_top_section">
                <button type="button" name="burgerMenu" className="burgerMenuClosed" id="burgerIco" onClick={() => toggleBurgerMenu()}>
                    <i id="bMenuIcon" className={burgerMenu ? "fas fa-angle-left" : "fas fa-angle-right"}></i>
                    <span id="bMenuText" className={burgerMenu ? "bMenuTextHideMessage" : "bMenuTextShowMessage"}>Hide</span>
                </button>

                <div className="profile_image" style={{"backgroundImage": "url('/img/pref/profilePic.jpeg')"}} alt="Astra London"></div>
                <h2 className="title">Astra London</h2>
                <h3 className="subtitle">Portfolio Gallery</h3>
          </div>



    <div className="searchBar">
      <form className="searchForm" onSubmit={(e) => searchSubmit(e)}>
        <button type="submit" className="searchButton">  <i className="fas fa-search"></i> </button>
        <input onChange={(e) => handleSearchForm(e)} type="text" name="search" className="searchInput" id="exampleInputName2" placeholder="Search..." />
      </form>
    </div>


    <ul className="main_links">
        <li className="main_link_header_li">
          <Link className="main_link_header" to="/home">HOME</Link>
        </li>
        <li className="main_link_header_li">
          <Link className="main_link_header" to="/Posts">POSTS</Link>
        </li>
        <li className="main_link_header_li">
          <Link className="main_link_header" to="/Albums">ALBUMS</Link>
        </li>
    </ul>



  </div>

    );
}

export default Header;
