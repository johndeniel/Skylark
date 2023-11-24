// Import the `router` and `extractor` modules from the current crate
mod router;
mod extractor;

// Define an asynchronous `run` function
pub async fn run() {
    // Create a new `axum::Router` instance by calling the `app` function from the `router::routes` module
    let app: axum::Router = router::routes::app();

    // Bind the server to the address "0.0.0.0:3000" and serve the `app` using `axum::Server`
    axum::Server::bind(&"0.0.0.0:3000".parse().unwrap())
        .serve(app.into_make_service())
        .await
        .unwrap();
}