/**
 * This function defines the rules for web crawlers, allowing them to index
 * and crawl all content across the entire website.
 *
 * @returns {MetadataRoute.Robots} The metadata configuration specifying 
 *                                the rules for web crawlers' behavior.
*/

import { MetadataRoute } from "next";

export default function robots(): MetadataRoute.Robots {
  return {
    rules: {
      userAgent: "*",
      allow: "/",
    },
  };
}