import React, {useState, useEffect} from 'react';
import Header from './partials/Header'
import Footer from './partials/Footer'
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
      
                <div className="mainGallery">

        { loading ? "loading" :

      <div className="gal_area_container">
          Search: {props.match.params.query}
        <div className="gal_area">
        {state.currentPosts.map((post) => { 
            return (
            <Link key={post.id} style={{ "backgroundImage" : " url('img/uploads/image.5e740cac5a93b5.27426162.png');"}} className="image_link" to={`post/${post.id}`}>
                <div className="filter">
                    <h2 className="name">{post.title}</h2>  
                </div>
            </Link>
           )
        })

        }
        </div>
  </div>
}

 
</div>

{/* Paginator Buttons */}
{!loading &&
    <div class="frontend_pagination_container">
        {currentPage > 1 && <button onClick={() => prevPage()}>Prev page</button>}
        {!isLastPage && <button onClick={() => nextPage()}>Next page</button>}
    </div>
}

<Footer></Footer>
                
            </div>
            
            
        </div>
    );
}

export default Search;