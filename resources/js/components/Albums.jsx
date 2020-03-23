import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'
import ReactHtmlParser from 'react-html-parser'


const Albums = () => {

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);
    
    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(4);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;

    const fetchItems = async () => {
        await fetch('/api/category')
        .then((response) => {
            return response.json();
          })
        .then((data) => {

            // add the current range of posts to the state
            let currentItems = data.categories.slice(indexOfFirstPost, indexOfLastPost);
            indexOfLastPost >= data.categories.length ? setIsLastPage(true) : setIsLastPage(false);
            setState({...data, currentItems});

            setLoading(false);
            }
        );
    }

    useEffect(() => {
        loading ? fetchItems() : null;
    });

    // paginator page functions
    const nextPage = () => {
        setCurrentPage(currentPage + 1);
        setLoading(true);
    }

    const prevPage = () => {
        setCurrentPage(currentPage - 1);
        setLoading(true);
    }

    return (
        <div>
            <Header />

            <div id="mainContent" className="main_content">
                {loading ? <Loading /> : 
                    <div>
                        <div class="alb_area_container"> 
                            <div class="alb_area">
                            {
                                state.currentItems.map((category) => {
                                    return (
                                    <Link class="album_link" to={`/album/${category.id}`}>
                                        <div class="album_link_img" style={{ "backgroundImage" : `url(${category.image})`}}></div>

                                        <div class="album_link_text">
                                            <h2 class="album_link_name">{category.title}</h2>
                                            <p class="album_link_desc"> {ReactHtmlParser(category.body)} </p>
                                        </div>
                                    </Link>
                                    )
                                })

                            }
                            </div>
                        </div>
                    
                        <div class="frontend_pagination_container">
                            {currentPage > 1 && <button onClick={() => prevPage()}>Prev page</button>}
                            {!isLastPage && <button onClick={() => nextPage()}>Next page</button>}
                        </div>
                    </div>
                }
                <Footer></Footer>
            </div>

        </div>
    );
}

export default Albums;
