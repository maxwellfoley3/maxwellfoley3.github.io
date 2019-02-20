How Bitcoin works

1. The purpose of Bitcoin 

What is Bitcoin?

Bitcoin is money that can be transferred over the internet directly between two people. 

Unlike all pre-existing alternatives to Bitcoin, there is no need to have a third party like a bank or a payments company handling and processing all transactions. You just send your money directly to the other person and there is nobody who can tell you not to, nor can they freeze your account if your activity looks suspicious. It's like if you met up with them in an alley and directly handed them a fistful of gold coins - but instead you are just sending a message over the internet. 

The analogy to a gold coin fits in many ways, but it can be misleading in the sense that beginners often assume that there is some sort of piece of data or file on the user's computer that represents "the Bitcoin" and is being passed around. This is not the case. Bitcoin is simply represented by numbers on a ledger - a virtual accounting book. To say "I own one Bitcoin" is to say that we can look at this accounting book, read the numbers, and show everybody that I have one Bitcoin associated with my name.  

So, understand that Bitcoin is really just a database of sorts that represents how much money each participant in the system has. 

Specifically, it's a ledger - a list of all payments that have been made in the system. Once you have this list, you can calculate how much money any individual person has just by adding up all transactions in which they got paid, and subtracting transactions in which they spent money. 

This is similar to how money is represented by online banks and credit card companies - they keep a big database with a record of all payments made in the system and as payments go through they add and subtract from the little number by your name that tells you how much money you have. The difference is that this service is centralized - it requires all payments to go through and be managed by a third party. As we will see, in making it decentralized, we add enormous amounts of confusion and complexity to the database model; a lot of innovative mathematical thinking is required to make everything work.

Why decentralize? 

Why do we want decentralized money? The first and most obvious reason is that we are putting a lot of trust in our third party in a centralized system to handle our money properly. This isn't necessarily paranoid. In practice, banks often do arbitrarily revoke access to funds and do all sorts of inappropriate things with their customers' trust. For example, in the Equifax data breach, millions of users who had never used Equifax were affected because their bank had shared their data with Equifax with no opportunity to opt out. The stress caused by needing to trust someone else to hold onto your money for you is a genuine frustration felt by many. 

The second reason is because a centralized system has a central point of failure. If all transactions are processed and stored in a server in, say, Dubai, then someone could just go to Dubai, walk into the offices of our currency company, and smash the server to pieces with a hammer. Then the service would not be functional. Nothing like this is possible with Bitcoin because there is no central server to smash to bits. 

Why would someone want to destroy our system? One reason is that they might have a financial incentive to ruin the currency. (A very simple one could be that they had just an hour ago gone down to the stock exchange and put in a short order on it). 

Another reason could be that they work for the government and want to shut the service down. Perhaps they are against the freedom our new currency allows its users - to commit crimes without being traced, or to set up alternative societies removed from the existing infrastructure. 

This is not some sort of a hypothetical from a dystopian novel - it is actually what happened. Before Bitcoin was invented, there was a similar service called E-Gold that worked in a centralized way and was owned and operated by a standard corporation. It ran for about thirteen years and got in repeated issues with the government until eventually the feds raided their offices, shut everything down, seized their assets, and held the owners criminally accountable as "unlicensed money transmitters".  Given that Bitcoin's major practical usage, at least initially, has been buying drugs on the darknet markets, the government almost certainly would have already tried to shut Bitcoin down too at some point were it feasible for them to do so. Designing cryptocurrency systems in a way that prevents governments from interfering with them is a very practical, necessary concern. 

Peer-to-peer software

Thinking about decentralized systems is something that is very unnatural to people. When we are working through the design of a system like Bitcoin, it will be tempting to ask something like "Wait, so at this point can whoever's in charge just tell people not to…". No. There is no person in charge who can just decide to make changes. 

Not only is this completely different from most organizations we deal with in our lives, including the government, it is totally different than most software. Typical internet platforms like Google or Facebook run on the client-server model. Your computer or phone is the "client", and the server is a computer somewhere in Google or Facebook's headquarters. When you update your Facebook status, for example, your client sends a message to Facebook's server telling them what you want to do, and then assuming your internet connection is good, the server recieves it and processes it and then potentially runs various programs and makes a whole bunch of changes in the database.

Bitcoin is peer-to-peer software, which means that there is no server and there are only clients. The clients connect to each other and form a network in which they transmit messages back and forth. When you, for instance, want to send a payment to your friend Alan for picking you up from the airport, there's no server you can notify to tell them that this is what you want done. You have to just tell as many of the other clients as you can, i.e. the other users just like you. 

Now, if you are paying attention, you may be wondering something. I told you that Bitcoin is esssentially a database, but there is no server to store this database on. Where is the database stored? The answer is that every user stores their own copy of the database on their own computer. The users all talk to each other in order to figure out what new payments have occurred and they try to keep their copy of the database up to date.

At this point, let's take a step back and consider how difficult the problem posed to us is, if we were to be the ones designing this system from scratch. 

The situation is like this: Imagine that somewhere in a totally lawless zone with no king or ruler to enforce order, there is a market where people are running around transferring money to each other. Only they are not able to hand over any sort of physical money. If someone wants to buy a goat from you for ten coins, he has no ten coins to give you - instead he simply says "Okay, I am giving you ten imaginary coins now". Everyone is busy frantically scribbling down in a book they carry with them every transaction that occurs so they have a record of how many imaginary coins everyone has at any given point. When someone tells you he is giving you ten coins for your goat, you have to make sure he actually has ten coins to his name and that after he buys your goat everyone else will understand and agree that you have ten coins more than you did before and he has ten coins less, otherwise the money is useless. So you are double checking everything in your book, and comparing your book to others' to make sure it's right, and as soon as the transaction is over going around yelling to everyone "Look, I have ten more coins than I did before! Is your book updated yet? Update it now!" 

We have to figure out how, in this totally anarchic system, we can get everyone to agree on their books. If the guy three shops over says that I have three coins to my name and the guy next to me says I have four, then the whole situation is completely screwed up. If no one knows for sure how many coins I have, I might as well have zero. 

Furthermore, we can't assume that everyone in the situation is working together to try to get a consensus. We have to assume, given the lawlessness and the ability to profit, that everyone is constantly trying to cheat and swindle everyone else and if they could get away with it they would simply lie and tell everyone that the books should say that they have ten million imaginary coins, and everyone else has zero. 

And to make things worse, we cannot order anyone to do anything, because this is an anarchic system. All we can do is recommend that people conduct business in a certain way and design these recommendations so elegantly that simply by getting enough people to reliably follow these recommendations, a stable system of order emerges. Just as an example - if we recommend to everyone "if you see someone who is a known swindler, refuse to do business with them entirely, in fact don't even make eye contact", then maaaybe swindlers will realize that maybe if enough people are following these recommendations swindling won't be worth it, so even if they are purely greedy they will do something else. In reality, much more complicated, clever "recommendations" are necessary.
 
To be more specific - this is an analogy for the nature of software on a peer-to-peer network. The people who have created Bitcoin have published a software program that communicates on this network and honestly follows certain rules and protocols for sending messages, i.e. it won't try to spend money it doesn't have, it does its best to maintain an accurate copy of the ledger and forward this copy to other users, etc. 

A user who wants to use Bitcoin in an honest way is probably just going to download this software and use it since it works. However there's nothing from stopping any malicious or greedy user from writing their own software which sends whatever it wants. Maybe it tries to lie and forge transactions, or maybe it just spams all users with random crap in order to waste their computers' resources processing it. Either way, Bitcoin developers have to consider all hijinks that unsavory sorts might try to pull when designing the rules that the honest software will follow. 

Satoshi Nakamoto, the founder of Bitcoin, figured out a solution to this problem. Using his protocol, we can guarantee that the only possible way to send a single false transaction is to have greater computing resources than all honest actors combined. 

How is this possible? The answer is firstly, a magical cryptographic way to sign your transactions so no one else can spend your money. This then ties into an ingenious, elegant design known as "the blockchain" which can only really be understood and appreciated in full, because it is like no other system that exists for any other purpose. Let us dive in.

2. Cryptographic identity 

Before we get into the bigger pitcure of the blockchain, let's explain the mechanism that makes it so no one is allowed to spend our money but us. That is - how we can do the equivalent of securely "logging into" Bitcoin, when there is no central server to log into?

The centralized solution to this is the username and password system. You show everyone your username, and your password is a secret just between you and the server. 

Bitcoin actually has a similar thing going on, only it uses the magic of cryptography to create a system where no server is required to check your password, and you never have to share it with anyone in the world. Instead of a password, you have a private key, and instead of a username you have a public key.

You generate a public key by running your a private key through a specific function, but given a public key, there is no way you can go backwards and figure out the private key that generated it. So you can tell whoever you want your public key, and your private key will remain secret.

The thing you can do that makes it special and makes Bitcoin work is: You can "sign" any piece of data in a way that tells people that only the person who knows the private key that corresponds to a certain public key could have possibly made that signature. However, knowing this information does NOT get you any closer to knowing what that public key actually is. 

How does it work? Magic - don't worry about it. Well, the magic of cryptography. This system involves quite complicated math and explaining it is outside the scope of this article. Just know that this is something we can do. 

Let's illustrate a situation outside of Bitcoin where you might want to use this technolog. Imagine that I am the owner of one of several illegal online drug marketplaces. Let's say I want to create a Twitter account so that I can notify my users about updates and so on. But I want them to know that the account is actually run by me, not an imposter. Twitter's centralized solution to this is to let you contact a customer relations person who will verify your ID and face and give you a "blue check mark" on your profile. But I cannot share my identity with Twitter, since I am the ringleader of an enormous criminal conspiracy and letting anyone know my name would be unwise. 

What I can do instead is publish my public ket somewhere on my drug marketplace, and then in my Twitter bio write something like "I certify that this Twitter account, @whatever, is ran by the owner of Whatever-My-Drug-Market-Name-Is". Then I sign the message with my private key and post the signature along with it. The signature is just a long random-looking string of letters and numbers, but you can run it, my message, and my public key together through a "magic" function to prove that it's valid. Now anyone can verify that the owner of my drug-selling website and the owner of my Twitter account are the same person - the owner of a certain private key. 

Bitcoin uses this exact same principle, it's just that the messages you're signing are the transactions you send.

There is some complexity going on here that I'm going to gloss over, because if you think about it - imagine the message I send is just "Send 5 Bitcoin from John to Jane, signed John". There's a problem with this, because if Jane is allowed to add transactions to the database, she could copy and paste this message one hundred times into the database and therefore get 500 more Bitcoin from me than I intended to give her. Bitcoin has a kind of complicated data model in which transactions are given unique identifiers that ensure they can only be spent once and thus prevent things like this, but I don't think it's worth going into in this article because you don't really need to understand it to understand the essence of how Bitcoin works. If you're interested in reading more, it's explained in Section 3 of the Bitcoin whitepaper. 

Anyway, when you want to receive Bitcoin from someone, you have to give them your address, and your address is what they specify when submitting a transaction in order to declare who the payment is for. Your address is the equivalent of a Bitcoin username, but it's not simply your public key, rather your public key ran through a second function called a "hash", which we will explain in detail soon. The reason for this is technical and beside the point, but it's basically an extra layer of security. Many people incorrectly will tell you that that the address and the public key are the same thing, but now you won't make that mistake.

Bitcoin addresses, public keys, and private keys look something like this: 1JryTePceSiWVpoNBU8SbwiT7J4ghzijzW. It looks bizarre and frightening, but this is actually just a number. It happens to be formatted in a system called Base-58 which we use to write numbers in a way using a mix of numerals and letters in order to save space. Don't worry - you don't have to understand how this works to use Bitcoin either!

So when you're running the Bitcoin software, you tell it your private key, or if you're using it for the first time it will generate a random one for you and let you write it down somewhere or store it safely in a file somewhere. It's then able to scan the blockchain for funds in the address that corresponds to your private key, and thereby display to you your balance. When you send transactions, it broadcasts them signed alongside your public key in order to prove that only you could have spent them. 

There are some problems with this system.

The first is that if someone figures out your private key, they can steal all of your funds instantly, and you have absolutely no recourse when it comes to getting them back.

The second is that if you lose or forget your private key, there is no way you will ever be able to access your money again. This happens tragically often - it's estimated that roughly 25% of Bitcoin in existence today have been lost. 

Actually, these are not problems with private key cryptography at all. They are problems with the nature of a decentralized network. Since there is no server anywhere storing your private key, there is no one you can ask to give it back to you if you lose it. Since no one can censor, block, or reverse your payments, no one can stop the payments a thief makes from your account either. Removing authority means removing authority - there is no one that is going to come save you if you're not keeping your funds safe. You must assume that responsibility yourself. All the security and protection that a bank may give your money is entirely on you to provide now. 

What if someone guesses your private key? 

It won't happen, assuming you generate your private key randomly and don't do something idiotic and use a number like 696969696969 or 3. A valid private key is a number between 0 and 2^256, which means the the odds of someone randomly guessing your private key are 1 in 115,792,089,237,316,195,423,570,985,008,687,907,853,269,984,665,640,564,039,457,584,007,913,129,639,936. Calling this "astronomical" odds is appropriate, because it's roughly the same as the number of atoms in the known universe. 

To elaborate: if you had started guessing private keys, one per nanosecond (equal to one billion per second), from the Big bang up until now, you would have been able to guess 409,968,000,000,000,000,000,000,000 private keys by now. Let's assume that the lifespan of the universe is about halfway done, and that when this universe dies a new one will be reborn. If this was the case, you could guess one private key per nanosecond while 282,441,774,083,138,672,831,955,140,422,393,718,176,223,472,723,823 universes live, blossom and die. At that point, after all that work, you would have a better than average chance of having guessed my private key. So - good luck with that!


3. Blockchain & mining

Now we know how it is possible that only you can spend your own money. But: How is it possible that everyone can agree on what everyone else's balance is, when there's no central server to co-ordinate? 

Recall our illustration of an anarchic market in which everyone is frantically running around trying to agree on their books, scribbling things down and trying to reach some sort of consensus. We will now outline a system in which it's possible for them to actually reach this consensus and agree on a single valid history of transactions. 

Miners: a special type of user

First off, we will decide to trust the task of writing in our ledger to a special group of users which we could perhaps call "publishers" or "validators", but are typically known as "miners".

Anyone who wants to can become a miner, but no user is required to. Why would someone choose to be a miner or choose not to be a miner? Mining is essentially a business opportunity. It requires up-front purchase of powerful computers, requires you to spend money on a daily basis, requires you to work to maintain your devices, and after all that one hopes that at the end of the day one makes more money than one spends, but this is not a guarantee. So like any business, there are some people who will seize this opportunity in the hopes of making money, but there are others who will pass it up because it's too risky or requires too much investment or for any other reason. 

Like earlier, the analogy to gold implied in the term "mining" is slightly misleading. People are generally aware of the fact that miners spend massive amounts of computing power and are rewarded with newly created Bitcoin in some sort of complicated process. This may lead people to imagine that in order for new Bitcoin to physically exist it is somehow necessary to crunch a whole bunch of math, or that each Bitcoin somehow "represents" a certain amount of computing work, or something like that. I saw a popular tweet that read something like: "Bitcoin explained: imagine that keeping your car idling 24/7 creates solved sudokus that you can trade for fentanyl". This tweet is making this false assumption - that one Bitcoin equals one "solved puzzle" which thereby gives it value.

This is all wrong. A Bitcoin is just a number in a (decentralized) ledger. If a transaction in a ledger says I got paid 8 Bitcoin, and I can somehow change this number to 9, then I have 9 Bitcoin. No solved sudoku is needed.

The purpose of mining is not to create Bitcoin. Rather, the purpose of mining is to do what the central server would do in a centralized system - process everyone's transactions and update the database. The newly created Bitcoin is the reward for doing this. It's almost like in order to manage our database in a decentralized way we have simply contracted everything out to a bunch of freelancers we are paying in Bitcoin. 

Similarly, the purpose of requiring enormous amounts of computing power is not to actually solve some sort of useful mathematical problem. In fact, the calculations are meant to be as useless as possible. We make miners perform these calculations in order to force them to spend a whole bunch of real-world money up front burning energy toward no practical end before they get their Bitcoin, as a sort of "tax" on submitting proposals to update the database. This tax is called a "proof of work" - the miner needs to prove that they have done a certain amount of computing work in order to be allowed to publish. We will get more into this in a second. 

The miners are responsible for listening for all transactions that happen on the network and reporting them. The miners do not record transactions in the database one at a time, but rather hundreds at a time in batches called "blocks". Hence "blockchain" - the database is a growing chain of blocks. The system is designed so that one block is published every ten minutes. Blocks can only be added and not modified. When a miner writes a block, he is allowed to write a transaction crediting himself a certain amount of newly minted Bitcoin - this is his reward. 

Also, miners can collect transaction fees from users. As a user, you can choose to include a payment to the miner attached to a transaction you send out. This is basically a bribe or a tip in exchange for making sure your transaction is picked up in the next block. If the miner puts it in his new block, he gets to credit the fee you gave him to his own account. 

What happens if the miner did not manage to hear about and record your transaction in time? It is simply like it didn't happen yet! You need to hope it gets included in the new ten-minute round of mining that is about to start. Try giving the miner a higher transaction fee. 

Let's revise our little scenario of people trading while carrying books in a lawless marketplace with these new details. No longer does the average person in this situation have to worry about updating the book they carry with them themselves by recording transactions one by one. Rather there are a group of publishers (representing the miners) walking around earning money by recording every transaction they learn about in their books. Once anybody makes a transaction, he needs to go tell as many publishers as he can about it in order to hopefully get it published. Every ten minutes, a publisher is somehow chosen to put the latest page of his book (the new block) to through a photocopier, and then copies will be distributed to all the members of the marketplace so that everybody involved has a record. Now everyone's books are the same - no more anarchy. 

We can now see that using this system, we can maintain a consistent, updating ledger-book that everyone involved in the system can agree on, as long as we can trust the publishers to all agree on one new, valid block to publish at a time. The publishers/miners using this system can easily ensure that no one is spending money that they don't have, since they are able to look in the ledger-book and see all the transfers a certain person has made and calculate what that person's balance should be at that moment. If it's not enough to send a transaction, they will not record it. Also, it is impossible for them to forge a transaction from someone else because transactions require our magic unforgeable signature. The users don't have to blindly trust the miners/publishers either, because they can verify all this themselves.


Consensus

We now need to figure out how exactly we can get miners, and therefore users, to agree on what the newest block is. We've secured our system against people spending more money than they have, and from people spending other people's money, but if we can't get our strategy for consensus right, there is one, subtle way left for people to cheat in our system and defraud us. This is called the double-spend attack. Figuring out how to prevent this is a big deal. In fact, before Bitcoin, people had been proposing ideas for digital currencies for over a decade, but no one could figure out how to prevent the double-spend attack. The reason Bitcoin is the first successful decentralized digital currency is because it figured it out. 

Suppose a miner could make a transaction "un-happen", i.e. publish a transaction, and then take it back. This would enable them to do the equivalent of bounce a check. Let's say someone has 200 dollars worth of Bitcoin in his account and has figured out how to reverse transactions. In this situation he could, say, spend two hundred dollars worth of Bitcoin on a TV. Then he could take back his transaction, and spend that same amount of Bitcoin on an Xbox. Now he spent only $200, but has an Xbox and a TV - $400 worth of goods. The guy he bought the TV from is the loser in this situation, because he gave up his TV for nothing in return. 

This is why we need consensus. Without this agreement, there can be multiple competing versions of history, and it's possible for somebody to exploit this by spending on one, then on the other. 

To see why reaching consensus is tricky, let's abandon our metaphor about the chaotic marketplace, because even it contains too many known entities and is thus misleading. Imagine this instead. Imagine you have just stumbled into a pitch black, misty forest, the only light around you a small lantern you hold and the glow of the moon. You can see nothing and are navigating by touch and sound. A voice in the mist calls out to you "Hey. I'll give you a warmer jacket for five invisible coins." 

You want a warmer jacket, but something about this seems strange. "How do I know that you have five invisible coins?" you ask. 

"Here, check my ledger," he says, and a wrinkly hand thrusts some scribbled pages into the light of your lantern. You read it, it checks out, and because of the magic signatures you can tell it's impossible to be forged, but you're still not sure what you think. 

All of a sudden, a chorus of voices call out from the mist. "It's real!", say five hundred different voices from all around you. "I was there, I saw him get it! His book looks like mine!" You shudder. Though the voices are numerous in count, you have a terrible feeling about them. They might belong to humans just like you, but you can't be sure. They could be ghosts, spectres, shades, phantoms, illusions conjured up in multitude, twisting a tangled web, trying to deceive you. You can't figure out what's real.

This is all a metaphor for logging onto a peer-to-peer network for the first time. You have no idea what the history of the ledger is, and you need to get it from someone. But you have no idea who you're talking to, and since it's very easy for one person to run the same program across hundreds, even thousands of different computers (for instance through a cloud computing platform), you don't know how many people you're talking to. You don't know if you've managed to connect to everyone on the network or if there's a whole bunch of people on another "side" of the network you have no awareness of (a hacker can prevent you from accessing parts of the network in this way), so you can't do a head count.

When a miner publishes a new block, you have no idea if the rest of the network is going to accept it or not. You have no idea if its publisher is trying to trick you into accepting a fake history. You wish you could get a sort of majoriy rule, a vote on whether or not this block is going to be part of the real history or not, but you can't do a vote, because you can't do a head count! 

Except you can, and here is how: instead of counting heads, we count electricity. 

This is where the expensive, energy-wasting part of mining comes in. We force all miners to play a game where the winner gets the rights to publish the next block. The more electricity you spend on playing this game, the higher your odds of winning become. Your odds of winning are roughly proportional to the percentage of electricity you're pumping into the system compared to the total amount of electricity coming from all players. So in order to get favorable odds (51%) that you can publish the next block, you need to be spending more electricity than every single other miner combined. This is very hard to do, since the other miners are legions of unsolicited volunteers drawn from all across the world lured into playing by the simple attraction of profit. We are voting with electricity, but really we are voting with money. 

We've talked a lot about this mysterious electricity-wasting game, or puzzle, or what have you - let's actually describe how it works. 

First, we must understand something called a "hashing function".  

Hash

A hashing function is a function that can only be calculated one way. This means that if we are given an input to the function, we can calculate the output, but given the output, there is no possible way to work backwards and figure out the input. (So in that sense, it's like getting a public key from a private key, but it's not actually the same thing - the math is different.)

We won't go into the math behind this or how it works right now. All that's necessary is that you understand what it does. Again, just think of it like magic.

Furthermore, we can choose what range we want the output of the hashing function to take up, for instance we could use all the numbers from 0 to 9 (so only single digit numbers), 0 to 99, 0 to one million, or even something arbitrary like 0 to 894.  

Just to display how this works as clearly as possible, imagine that our hash function has the range of 0 to 9. We might input the number 3, and it will spit out, perhaps, the number 5. We could give it the number 30000000000000000, and maybe it will give us back the number 2. We could feed it the entire text of Moby Dick, and it might give us back the number 7. Now imagine we feed it the entire text of Moby Dick, but with one extra word added somewhere, maybe a "the" that Melville left out. You may think that since this input is so similar to the last one we put in, which returned the number 7, this one is quite likely to return a 7 as well, or maybe a number nearby like 6 or 8, or maybe it is more likely to be odd just like 7 is odd. If you were to think anything like that, you would be wrong. Despite the inputs being so similar, it is impossible to predict any correlation in the outputs. The only thing we know is that it will be between 0 and 10. Otherwise using the outputs only you could make guesses on what the inputs might have been, which breaks the rules of our hash. Knowing the output tells you nothing about what the input might have been.

Outside of cryptocurrency, hash functions are used for storing passwords on centralized web servers. Web databases get hacked fairly often, and if the hacker is able to just read everybody's password after a successful hack, this is bad news for users if they ever re-used their password on any other site. To make things safer for users, almost all modern websites will hash the users' passwords before storing them in the database. Therefore there is no way a hacker could figure out what the users' passwords were just from reading the database, since this would mean going from output to input of a hash function. What he reads looks just like a bunch of random numbers. But every time the user logs in, the server can properly verify that he is giving the true password, since the server can hash it once more (go from input to output) and see that it matches the already-hashed result that is stored on the database. 

Hash guessing game
 
On Bitcoin, we choose to reward the rights to publish a block to the miner who can run the block they are proposing through a hash function and have the output be a number in a certain range. The miner has to format the data they are publishing in an orderly, formatted way, but there is a spot where they are allowed to put a small amount of useless junk data (called a "nonce"). This is like if we were hosting a competition where we tell people to add one or two random words of gobbledegook to the text of Moby Dick and run it through a hash function to try to match its output to some specific magic number.

Essentially we are trying to go in reverse - given a hash output, the miner needs to find the proper input. 

"But wait! Didn't you just say that's impossible?" you say. 

What's impossible is to somehow deduce the input from the output through mathematical analysis. What is possible is to guess. 

Let's go back to our example of a hash function that spits out numbers between 0 and 9. Imagine that we are playing a Moby Dick Hashing Challenge where you can get a reward if your edit of Moby Dick with a few words of nonsense hashes to 3. This will be very easy, because someone's chance of getting 3 from any given input is 1 out of 10. They will only have to try an average of ten different inputs to win the prize. A standard CPU on a MacBook going as fast as possible can plug 88,000 guesses into the hash function per second, so it will actually only take a fraction of a fraction of a fraction of a second to get the answer.

If, say, there were fifty people all using MacBooks to compete in this challenge, and you wanted the competition to last roughly an hour, you could multiply 88,000 by 60 seconds times 60 minutes to get the number of guesses someone can do in an hour, and then multiply that by fifty for the number of people playing. So your hash function would have to have a much larger range: 0 to 88000 * 60 * 60 * 50, which is equal to 0 to 15840000000. 

Bitcoin uses very large numbers for the range of the hash function so that even with the vast amount of computing power going towards mining, it still takes an average of ten minutes to run this guessing game. As soon as someone wins at it, that is when that block is considered "published". 

You might be aware that more and more electricity has been thrown into mining given the increasing popularity and price of Bitcoin. How can it be that despite the amount of computers playing, the game still takes roughly ten minutes to play each time? 

The reason is because the Bitcoin network sets the "difficulty" of each block dynamically based on how long it took to calculate previous blocks. By this, we obviously don't mean that a centralized source is deciding this and telling everybody else what to do. Rather, each miner is calculating it themselves using the same function, the "difficulty function". The inputs to the function are how long it took to calculate blocks in the past, which is published on the blockchain. So every miner can agree on the inputs to this function and therefore every miner can agree on its ouput. Thus each miner knows exactly what variation of the hashing challenge they are trying to solve in order for their answer to be accepted by all the other miners. 

Bitcoin does not actually adjust the range of the hashing function to make the challenge easier or harder, but rather uses a fixed range: 2 to the power of 256. However in Bitcoin's version of the challenge miners are not racing to match a specific number, but rather the output of their hash function simply has to be under a certain cutoff. Adjusting this cutoff reduces the challenge. For example if we have a hash function with a range of one to ten million, we can set our cutoff to 2 to make the odds of a match one in ten million - the output has to equal 1 for the miner to win. Or we can set the cutoff to five million, making the odds 50% that someone will get it on their first try. On the Bitcoin network, the odds that someone will solve the challenge on their first try are always enormously small - much, much smaller than one in ten million, but given the amount of computing power directed towards solving the challenge all across the world, someone will still get it in around ten minutes. 

Putting the "chain" in blockchain

Once a miner has successfully solved the puzzle, what happens? How does he tell the rest of the network? How do all users come to accept the new block as canonical? What if there is disagreement? How do we end up creating one definitive history that there is no way to rewrite and therefore double-spend? 

Here we will explain a very elegant aspect of the design which ensures that miners will end up preventing double-spends simply for the sake of their own profit. We make the assumption in cryptocurrency that a certain percentage of users are "honest", and that this keeps the system running. But we never assume that miners are behaving honestly simply because they are honest people. Rather, we assume that they are behaving honestly because it is profitable to behave honestly, and because it is not profitable to cheat and lie. 

The brilliant idea that makes this possible is

1. Each block must include the hash of the previous block

and 

2. Users are told to always accept the longest valid chain of blocks as the canonical one

Together, these conditions make it so that as soon as a new, valid block is published on the network, miners have to drop the puzzle they were working on before, pick up the new block and put it in their chain, and start mining a new block completely from scratch. Why?

The fact that each block must include the hash of the previous block makes it so we can't re-use any of the work we already did.  Let's say that the chain is five blocks long at the moment (we must at a very early stage in Bitcoin's history, specifically fifty minutes after it was created). So we are trying to make block number six, and part of block number six is the hash of block number five. But let's say someone beats us to it, and publishes block number six before we do. Now we are trying to make block number seven, and we must include the hash of the other person's block number six, which we would have had no way of knowing before it was published. We can't keep trying to make block number six, because we are wasting our time - people have already accepted the chain with six blocks as the longest, and soon there will be a seventh if we don't hurry. Therefore we must start from scratch our goal of creating the next block if we want for it to be accepted and get a reward. 

Understand: a block only is valid in reference to another block that came before it. We speak of mining "on top of" another block.

What if two blocks are published at the same time? Miners will pick one or the other to mine on top of, and for a little bit, there will be two competing chains. Within a few blocks, one will very quickly become longer than the other, and that chain will become canonical while the other is abandoned, since users pick the longest chain. For this reason, users are recommended not to treat a payment as finalized until it is at least a few blocks deep. 

Now we understand why it is impossible to double-spend. Let's say there are ten blocks in the current longest chain. Merchants just accepted our payment in block five, since they figured it was deep enough. But we are trying to erase it in order to double-spend. Unfortunately for us, we are not going to be able to do this, because we are way behind compared to the longest chain. Every other miner is now racing as fast as they can to make block eleven. In order to suppress the existing block five, we would need to regain control of the longest chain by publishing seven more blocks (five, six, seven, eight, nine, ten, and eleven) before anyone else can publish one (block eleven). 

This is quite hard to do. In fact, we will generally only be able to do things like this regularly if we are spending more electricity than everyone else combined. This is called a 51% attack, since we would need 51% (well, rounded up) of the electricity going into the system in order to do this. It is Bitcoin's weakness - as long as this does not happen, the system is secure. 

This is also how a government could potentially destroy the Bitcoin network - if they constantly 51% attack to reverse history and replace it with a bunch of junk transactions, then no one's payments ever end up being recorded, and it is like nothing is going on on the Bitcoin network at all. But in order to do this they will need to spend as much electricity as the entire army of unsolicited volunteers from all around the world mining Bitcoin as fast as they can for a profit. So, that could be hard. 


4. Using Bitcoin in practice

We have talked a lot about the Bitcoin software and its users and so on, but it has all been totally hypothetical and removed from the real world. Let's discuss how people use it on a day-to-day basis

You may know a guy who told you he owns Bitcoin, or that he bought something with Bitcoin. Where did he get it from? How does he spend it? 

This can be kind of confusing because there are a bunch of different ways to own or spend Bitcoin, and the word "wallet" is used to describe most of them, despite referring to completely different things (software in one case, a piece of paper in another, for example).

Bitcoin banks

If the guy you know is in the US, he probably got his Bitcoin on Coinbase, a very user-friendly website where you can exchange US dollars for Bitcoin. Once you own Bitcoin, you can send it to any address you wish or exchange it for a few other different types of cryptocurrency on the platform, or convert if back into dollars if you regret your purchase.

You can also just keep it there forever and use Coinbase as your "wallet" to buy things and receive payments, which if you are storing any substantial sum of money is a bad idea. This is basically just using a bank. If your Bitcoin is on Coinbase, you do not actually own the private key or run the Bitcoin software, and nothing we talked about in the entire first three sections applies. Coinbase is running the Bitcoin software on their own server to process all of the transactions you make on it, and they are likely storing your Bitcoin in one enormous account mixed in with everyone else's. You are totally putting your trust in Coinbase to not just run away with your Bitcoin or block your payments. But it's much worse than traditional banking because you are not getting any security out of it, since crypto exchanges are a ripe, ripe target for hackers. Hacks of millions of dollars in cryptocurrencies happen all the time on exchanges and usually you are not going to see any of that money back. Coinbase is a fairly well-vetted company and is unlikely to just completely run off with your money, but this has happened numerous times with other, shadier exchanges. Some insane stories have made the news: recently, the CEO of QuadrigaCX, Canada's largest cryptocurrency exchange, appears to have moved to India and faked his own death in order to shut down the exchange and steal $40M in his customers' money. Crypto is a shady world and full of remorseless scammers looking for their next kill - don't let yourself be it! 

To spend and receive Bitcoin in a trustless way, you will need to download a Bitcoin client. The official software is called Bitcoin Core. Before Satoshi Nakamoto (the mysterious inventor of Bitcoin) disppeared from the internet never to be heard from again, he hand-picked successors for further development of his software, similar to Christ choosing Peter to lead the Catholic Church before he ascended into heaven. (Blockchain, the 21st century version of religion?) This lineage is now known as Bitcoin Core. However, anyone is free to develop and share their own alternative Bitcoin client if they disagree with something Bitcoin Core is doing or simply feel like making their own.

Bitcoin Core is open-source software, which means you can read the code yourself. Most software is not open-source, because software is usually developed for profit. Open-source software is difficult to sell because if the code is freely available people can just copy it and use it themselves without paying. Or they could make some quick changes and sell their version as a competitor. However, some people work hard, often for free, on creating open-source software because they believe it's to the benefit of humanity to have tools that are freely available and not just for the profit of a specific company. Sometimes they will be able to get grants from charitable foundations to do this. 

Cryptocurrency software pretty much has to be open-source, because otherwise it isn't trustless. If you can't read the code of your Bitcoin client, you would have no way of knowing it's not storing your private keys on a database somewhere and handing them over to the developers so they can take all your money! There are many competing open-source Bitcoin clients - I don't know if there are any closed source ones. If you see a client available that doesn't publish its code, this is an enormous red flag and you should not use it. 

Different ways to store and spend your Bitcoin

The Bitcoin Core software is what we call a "full node", which means when you run the software, after it starts connecting to other users on the network it will download, verify, and store on your computer the blockchain (the entire history of transactions thus far). This is a major problem for most users because the blockchain at this point is over 150 GB. For almost everyone, this means that you are going to need a dedicated machine just to run a Bitcoin full node. 

If you don't want to run a full node or buy a hardware wallet, you can download what's called a "light client", "light node", or "SPV client" (Simplified Payment Verification). This is a version of the Bitcoin software that doesn't store or validate the database, but rather has to ask someone else who is running a full node whenever it wants to know something about the state of the network. This is much better than using something like Coinbase where we don't own our own private keys, but it's still not a trustless solution because we need to rely on someone else to supply us with all the data we need. We won't even know, for example, how much Bitcoin we own until we ask someone else to tell us. Using a light client isn't a security issue in the sense that it enables anyone to steal your private key and therefore your Bitcoin, but it could allow people to defraud you since you can't be 100% sure that any payments to you have actually taken place, given that you can't read the blockchain. It's possible for fraudsters to mess with your network connection so that you think you're recieving valid data from full nodes indicating that you have been paid, but really you are just recieving lies from the person who is trying to buy your goods or services without legitimately paying. 

You can also find light nodes that run on the web or on your phone, which for most users is much more convenient than installing desktop software. However neither of these approaches can truly be secure. When you're using a web client, you could review the code in the website to make sure it's not sending your private keys to a server somewhere, but you would have to review it every single time you use it because they could have changed the website since the last time you checked it. With a mobile client, even if the software developer publishes their code somewhere, you can't download that code and build the software yourself on your iPhone - you have to go through the App Store, which means that you need to trust some combination of the developers and Apple/Google. 

Whether running a full node or a light node, a problem with computers is that they can always be hacked. If someone manages to install some sort of malware on your computer, they could potentially steal your private keys. For this reason, it's usually recommended to only store large sums of Bitcoin in "cold storage", which means not storing them in a client that's connected to the internet. 

This is easy, because all you need to do to "store" a sum of Bitcoin is to have access to the private key which owns it. So one form of "cold storage" is just writing down the private key on a piece of paper - this is called a "paper wallet". Ideally you would probably put this in a safe deposit box or something rather than, say, pinned to your refrigerator. Another form of cold storage is storing the private keys (perhaps encrypted with a password) on a hard drive not connected to the internet. 

Given the various tradeoffs involved with all these approaches, anyone who is storing and using a lot of Bitcoin is probably going to have multiple different means of storing their Bitcoin depending on how quickly they need to access the funds. Right now, as a user of the dollar, you might have, say, a few hundred dollars in cash in your wallet, a few thousand dollars in your checking account for less frequent, larger purchases, and tens or hundreds of thousands out of access and safe in your savings account. 

It's logical to do something similar to this with your Bitcoin. You can keep .1 Bitcoin (about $300 today) in something like Coinbase or a mobile client for quick payments. Then keep 1 Bitcoin in a desktop client for larger payments, probably a full node if you're receiving large payments you need to verify. And then keep most of your stash of Bitcoin secure in cold storage.

There are even more options I didn't go into here, like a hardware wallet -  a light client on a USB stick that keeps your keys as secure as possible by isolating them in a piece of silicon from which they cannot be extracted, and the Lightning network, a new service that allows for faster transactions by letting you open a sort of "bar tab" of transactions that you don't have to record on the blockchain until it's closed. Lots to talk about but this is long enough already!

Mining in practice 

What if you want to make a little bit of money on the side by mining Bitcoin? 

The answer is, unless you live in the Pearl River Delta region of China and have enormous amounts of capital to invest, you can't. It has not been possible to make any money mining Bitcoin on consumer hardware for quite some time. This is because miners, seeking to make as much money as possible, have invented types of computers that mine Bitcoin around 1000x faster than, say, your MacBook could. These computers are known as ASICs, or application-specific-integrated-circuits. They are extremely fast at mining Bitcoin because they are designed to do specifically that - in fact, they can do nothing else. It is as if they have programmed the hash function that mines Bitcoin physically in silicon on a computer chip rather than in software. 

Also, they rely on economies of scale to reduce the cost of electricity and cooling for a given computer, meaning that you need hundreds or thousands of these specialized computers side-by-side in a "mining farm" to profit nicely. For various economic reasons relating to availability of cheap electricity, all of these mining farms are located in a specific region of China. 

Is this a problem? Probably, yes. Bitcoin mining is very centralized in practice today. The current situation is nothing like how it was originally envisioned. 

There is not too much risk of one of these powerful miners trying to double-spend, since this would crash the price of Bitcoin and make their business unprofitable, but the Chinese government is a concern. Bitcoin mining being entirely located in one country is a risk, and China might be a particularly bad one for it to be in, since they are an authoritarian state that has the ability to take over powerful businesses should they choose to. Several alternatives to Bitcoin, such as Ethereum and Monero, have taken steps to neutralize ASICs and make consumer mining profitable again, but as far as I know of, no one is really advocating for Bitcoin itself to take steps in this direction.




[insert some kind of conclusion here] 


