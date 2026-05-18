import 'react-native-gesture-handler';
import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import { StatusBar } from 'expo-status-bar';
import { AppProvider, useApp } from './src/context/AppContext';
import RootNavigator from './src/navigation/RootNavigator';

function Gate() {
  const { token } = useApp();
  return (
    <NavigationContainer key={token ? 'authed' : 'guest'}>
      <RootNavigator />
    </NavigationContainer>
  );
}

export default function App() {
  return (
    <SafeAreaProvider>
      <AppProvider>
        <Gate />
        <StatusBar style="light" />
      </AppProvider>
    </SafeAreaProvider>
  );
}
