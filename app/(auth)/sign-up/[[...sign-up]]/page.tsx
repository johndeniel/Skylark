import { SignUp } from "@clerk/nextjs";

export default function Page() {
  return (
    <div className="flex justify-center py-24">
       <SignUp
        appearance={{
          layout: {
            privacyPageUrl: "/privacy",
            showOptionalFields: true,
            termsPageUrl: "/terms",
          },
        }}
      />
    </div>
  );
}