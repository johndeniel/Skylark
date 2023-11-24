use axum::{
    routing::get,     // This code imports the necessary dependencies from the Axum framework. 
    Router,           // Axum is a web framework built on top of the hyper HTTP library for Rust.
};



#[tokio::main]
async fn main() {
    // build our application with a single route
    let app: Router<_, _> = Router::new().route("/", get(message));

    // run it with hyper on localhost:3000
    axum::Server::bind(&"0.0.0.0:3000".parse().unwrap())
        .serve(app.into_make_service())
        .await
        .unwrap();
}

/* This is the main function of the program. It's marked as asynchronous (async) and annotated with #[tokio::main]. 
The #[tokio::main] attribute specifies that the Tokio runtime will be used to execute the asynchronous code.
Inside the main function, the application is built and then run. First, an app variable of type Router is created. 
The Router is the core component of Axum, responsible for handling incoming HTTP requests and routing them to the appropriate handlers.
In this case, a single route is defined using the route method of the Router. The route is defined as "/", which means it matches requests to the root URL. 
The handler for this route is specified as get(message). It means that when a GET request is made to the root URL, the message function will be called to handle it.
Next, an Axum server is created using axum::Server::bind. It binds the server to listen on the address "0.0.0.0:3000", which means it will listen on all available network interfaces on port 3000. 
The bind method returns a server builder, to which the serve method is chained. The serve method takes the app and converts it into a service using into_make_service(). 
Finally, the server is started by calling await on it. */



async fn message() -> String {
    "Hi Guys!".to_owned()
}

/* This code defines the message function, which is the handler for the defined route. 
It's an asynchronous function (async) and returns a String. In this case, it simply returns the string "Hi Guys!" as an owned (to_owned()) string.
Overall, this code sets up a simple web server using Axum and responds with "Hi Guys!" when a GET request is made to the root URL ("/"). */