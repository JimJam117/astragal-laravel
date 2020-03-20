import React, {useState, useEffect} from 'react';
import ReactDOM from 'react-dom';
import Link from './Link';

const App = () => {

    const [state, setState] = useState({});
    const [loading, setLoading] = useState(true);

    const fetchItems = async () => {
        await fetch('/api/post')
        .then((response) => {
            return response.json();
          })
        .then((data) => {
            setState(data);
            setLoading(false);
            console.log(data)
            }
        );
    }

    useEffect(() => {
        loading ? fetchItems() : null;
    });

    console.log(state);

    return (
        <div>
            {
                loading ? "loading" : state[0].map((post) => {
                    return <Link key={post.id} title={post.title} />
                })
            }
        </div>
    );
}

export default App;


if (document.getElementById('Test')) {
    ReactDOM.render(<Test />, document.getElementById('Test'));
}

