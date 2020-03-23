import React from 'react'
import FadeLoader from "react-spinners/FadeLoader";

export default function Loading(props) {
    
  return (
        <div style={props.white ? {backgroundColor : 'white'} : null} className={props.opacity == 1 ? "loading-page opacity" : "loading-page" }>
        <FadeLoader
          height={15}
          width={5}
          radius={2}
          margin={2}
          color={"#555"}
          loading={true}
        />
        <p>{props.text}</p>
        </div>
    )
}
