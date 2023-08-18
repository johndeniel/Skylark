"use client"

import React, { useEffect, useState } from "react"
import WritingList from '@/components/WritingList'

interface WritingItem {
  title: string;
  slug: string;
  date: string;
}

interface ViewCountItem {
  slug: string;
  view_count: number;
}


export default function Home() {


  const [allPosts, setAllPosts] = useState<WritingItem[]>([]);
  const [viewCounts, setViewCounts] = useState<ViewCountItem[]>([]);

  useEffect(() => {
    // Fetch dummy data here
    const dummyPostSlugs: WritingItem[] = [
      { slug: 'dummy-post-1', title: 'Serif', date: '2023-08-01' },
      { slug: 'dummy-post-2', title: 'Sans-serif', date: '2023-06-02' },
      { slug: 'dummy-post-2', title: 'Script', date: '2023-02-12' },
      { slug: 'dummy-post-2', title: 'Display', date: '2024-08-02' },
      { slug: 'dummy-post-2', title: 'Slab-serif', date: '2024-08-22' },
      { slug: 'dummy-post-2', title: 'Italic', date: '2023-01-02' },
      { slug: 'dummy-post-2', title: 'Bold', date: '2024-08-22' },
      { slug: 'dummy-post-2', title: 'Ligature', date: '2023-08-02' },
      { slug: 'dummy-post-2', title: 'Kerning', date: '2023-08-02' },
      { slug: 'dummy-post-2', title: 'Tracking', date: '2023-08-02' },
      { slug: 'dummy-post-2', title: 'Leading', date: '2023-08-02' },
      // ... Add more items here ...
    ];

    const dummyViewCounts: ViewCountItem[] = [
      { slug: 'dummy-post-1', view_count: 100 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      { slug: 'dummy-post-2', view_count: 75 },
      // ... Add more items here ...
    ];

    setAllPosts(dummyPostSlugs);
    setViewCounts(dummyViewCounts);
  }, []);



  return (
    <React.Fragment>
   <section className="container max-w-[74rem] space-y-6 py-8 md:py-12 lg:py-24">
   <div className="mx-auto flex max-w-[58rem] flex-col items-center space-y-4 text-center">
       <h2 className="font-heading text-3xl leading-[1.1] sm:text-3xl md:text-6xl">
       Typography
        </h2>
        </div>
      <WritingList items={allPosts} viewCounts={viewCounts} />
      </section>
    </React.Fragment>
  );
}

