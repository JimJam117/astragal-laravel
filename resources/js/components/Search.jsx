import React, {useState, useEffect} from 'react';
import Header from './partials/Header';
import Loading from './partials/Loading';
import Footer from './partials/Footer';
import {Link, Redirect} from 'react-router-dom'

const Search = (props) => {

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
            //throw errors if issues
            if (response.status === 500) {
                throw new Error("500");
            }
            else if(response.status === 419) {
                throw new Error("419");
            }
            else if(response.status === 429) {
                throw new Error("429");
            }


            return response.json();
          })
        .then((data) => {
            const searchResults = data.posts.filter(post => {
                // the words in the title
                let titleWords = post.title.toLowerCase().split(" ");

                // the words in the body (with tags stripped)
                let body = post.body.replace(/(<([^>]+)>)/ig,"").toLowerCase();
                let bodyWords = body.split(" ");

                // title words + body words
                let words = titleWords.concat(bodyWords);

                let containsString = false;

                words.forEach(word => {
                        if(word.includes(props.match.params.query.toLowerCase()) == true) {
                            containsString = true;
                        }
                });
                return containsString;

            });

            // add the current range of posts to the state
            let currentPosts = searchResults.slice(indexOfFirstPost, indexOfLastPost);
            indexOfLastPost >= searchResults.length ? setIsLastPage(true) : setIsLastPage(false);
            setState({...data, currentPosts});

            setLoading(false);
            }
        ).catch((e) => {
            if (e.name !== "AbortError") {
                if (e.message === "404") {
                    window.location.href = "/not-found";
                }
                else if (e.message === "500") {
                    window.location.href = "/server-error";
                }
                else if (e.message === "419") {
                    window.location.href = "/page-expired";
                }
                else if (e.message === "429") {
                    window.location.href = "/too-many-requests";
                }
            }
        });
    }

    useEffect(() => {
        loading ? fetchItems() : null;
    });

    // if query changes, set loading to true
    useEffect(() => {
        setLoading(true);
    }, [props.match.params.query]);
    

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
            { loading ? <Loading text="Searching..." /> :
                <div>
                    <div className="mainGallery">
                        <div className="gal_area_container">
                            <div className="ResultsBanner"> Search results for: {props.match.params.query} </div> 
                            {state.currentPosts.length == 0 ? <div className="no-results"><div className="sad">😢</div> No posts found</div> :
                                <div className="gal_area">
                                { state.currentPosts.map((post) => { 
                                        return (
                                            <Link key={post.id} style={{ "backgroundImage" : `url('${post.thumbnail}')`}} className="image_link" to={`/post/${post.id}`}>
                                                <div className="filter">
                                                    <h2 className="name">{post.title}</h2>  
                                                </div>
                                            </Link>
                                        )
                                    })
                                }
                                
                                </div>
                            }
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

export default Search;
