import type { FC } from 'react';

import FlashIcon from '@components/icons/flash';
import CodeDocumentIcon from '@components/icons/code-document';
import MagicIcon from '@components/icons/magic';
import ServerIcon from '@components/icons/server';
import { card } from '@components/elements';

interface FeaturesProps {}

export const features = [
  {
    name: 'Feature-rich',
    description:
      'Packed with powerful features Tags, Categorization, Color Variants, Filter Search, and more.',
    icon: <FlashIcon className="stroke-black dark:stroke-white" />
  },
  {
    name: 'JSON',
    description:
      'Effortlessly manage log data with our API, using JSON for structured, accessible, and integrated insights.',
    icon: <CodeDocumentIcon className="stroke-black dark:stroke-white" />
  },
  {
    name: 'Safe',
    description:
      'Protecting Your Data with Strong Security Protocols for Confidence and Regulatory Compliance.',
    icon: <MagicIcon className="stroke-black dark:stroke-white" />
  },
  {
    name: 'Framework agnostic',
    description:
      "Skylark Logging API has a utility library that works with any framework. It's not tied to React.",
    icon: <ServerIcon className="stroke-black dark:stroke-white" />
  }
];

const Features: FC<FeaturesProps> = () => {
  return (
    <section className="z-10 my-10 gap-6">
      <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
        {features.map((feature, index) => (
          <div
            key={index}
            className={card({ class: 'gap-2 p-4 backdrop-blur' })}
          >
            <div className="flex items-center">
              <div className="flex h-12 w-12 items-center justify-center rounded-full bg-neutral/10 dark:bg-white/10">
                {feature.icon}
              </div>
              <h3 className="mx-3 text-lg font-bold text-black dark:text-white">
                {feature.name}
              </h3>
            </div>
            <p className="pl-1 text-gray-500 dark:text-gray-400">
              {feature.description}
            </p>
          </div>
        ))}
      </div>
    </section>
  );
};

export default Features;
