// Import the `message` function from the `extractor` module in the current crate
use crate::extractor::message;

// Import necessary items from the `axum` crate
use axum::{
    Router,
    routing::post, 
    routing::get,  
};

// Define the `app` function that returns a `Router`
pub fn app() -> Router {
    // Create a new `Router` instance
    Router::new()
        // Define a route for the "/message" path using the `post` method
        .route("/", get(message))
        .route("/message", post(message::string_extractor))
}

async fn message() -> String {
    "Hi Guys!".to_owned()
}