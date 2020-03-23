import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
import Loading from './partials/Loading'
import {Link} from 'react-router-dom'

const Posts = () => {

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    // paginaton
    const [currentPage, setCurrentPage] = useState(1);
    const [postsPerPage, setPostsPerPage] = useState(9);
    const [isLastPage, setIsLastPage] = useState(false);

    let indexOfLastPost = currentPage * postsPerPage;
    let indexOfFirstPost = indexOfLastPost - postsPerPage;

    const fetchItems = async () => {
        await fetch('/api/post')
        .then((response) => {
            
            return response.json();
          })
        .then((data) => {
 
            // add the current range of posts to the state
            let currentPosts = data.posts.slice(indexOfFirstPost, indexOfLastPost);
            indexOfLastPost >= data.posts.length ? setIsLastPage(true) : setIsLastPage(false);
            setState({...data, currentPosts});
            console.log(data);
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
            { loading ? <Loading /> :
                <div>
                    <div className="mainGallery">
                        <div className="gal_area_container">
                            <div className="gal_area">
                                {state.currentPosts.map((post) => { 
                                    return (
                                    <Link   key={post.id}
                                            style={{ backgroundImage:  `url('${post.image}')` }}
                                            className="image_link" to={`post/${post.id}`}>

                                        <div className="filter">
                                            <h2 className="name">{post.title}</h2>  
                                        </div>
                                    </Link>
                                    )
                                    })
                                }
                            </div>
                        </div>
                    </div>
                    {/* Paginator Buttons */}
                    <div className="frontend_pagination_container">
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

export default Posts;
