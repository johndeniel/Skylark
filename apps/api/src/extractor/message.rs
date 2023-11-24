// Define an asynchronous function named `string_extractor` that takes a `body` parameter of type `String`
// This function is expected to be used as an endpoint for handling POST requests
pub async fn string_extractor(body: String) -> String {
    body    // Return the `body` string as the response
}