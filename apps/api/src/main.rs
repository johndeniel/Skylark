use skylark::run;

#[tokio::main]
async fn main() {
    // Call the `run` function, which executes the logic defined in the `run` function
    // The `await` keyword suspends the execution of the `main` function until `run` completes
    run().await;
}