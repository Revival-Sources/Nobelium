<roblox xmlns:xmime="http://www.w3.org/2005/05/xmlmime" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="http://www.roblox.com/roblox.xsd" version="4">
	<External>null</External>
	<External>nil</External>
	<Item class="{{ $asset->type }}" referent="RBX0">
		<Properties>
			<Content name="{{ $asset->templateName }}"><url>{{ $asset->templateUrl }}</url></Content>
			<string name="Name">{{ $asset->name }}</string>
			<bool name="archivable">true</bool>
		</Properties>
	</Item>
</roblox>