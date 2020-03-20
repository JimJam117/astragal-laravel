import React from 'react';

const Link = (props) => {
    return (
        <div style={{'backgroundColor':'grey', 'margin' : '10'}}>
            <h1>Title: {props.title}</h1>
        </div>
    );
}

export default Link;
