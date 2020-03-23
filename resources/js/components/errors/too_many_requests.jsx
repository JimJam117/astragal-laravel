import React from 'react'

export default function too_many_requests() {
    return (
        <div className="error-page">
            <h1>429</h1>
            <div>
                <h2>Too many requests!</h2>
                <p>The server is receiving too many requests right now.</p>
            </div>

        </div>
    )
}
